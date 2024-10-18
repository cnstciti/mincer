<?php declare(strict_types = 1);

namespace common\models\parser;

use DiDom\Document;
use RuntimeException;
use Throwable;

class Parser
{
    private int $siteId = 0;
    private string $siteName = '';
    private string $hrefCatalog = '';
    
    
    public function __construct(int $siteId)
    {
        $site = SiteTable::findOne($siteId);
        
        if ( ! $site) {
            throw new RuntimeException(sprintf(
                'Ошибка выбора сайта ИД: %d',
                $siteId
            ));
        }
        
        $this->siteId      = $site->id;
        $this->siteName    = $site->name;
        $this->hrefCatalog = $site->hrefCatalog;
    }
    
    public function getSiteId(): int
    {
        return $this->siteId;
    }
    
    public function getSiteName(): string
    {
        return $this->siteName;
    }
    
    public function getHrefCatalog(): string
    {
        return $this->hrefCatalog;
    }
    
    public function getDocumentHref(string $url): Document
    {
        try {
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => '',
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => 'GET',
            ]);
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            
            return new Document($response);
            
        } catch (Throwable $e) {
            throw new RuntimeException(sprintf(
                'Ошибка открытия документа: %s. %s',
                $url,
                $e->getMessage()
            ));
        }
    }
    
    /*
    abstract public function getStyleCategories(): string;
    
    abstract public function getStylePagination(): string;
    
    abstract public function getStylePages(): string;
    
    abstract public function getStyleProductName(): string;

    
    public function uploadCatalog(): void
    {
        echo 'Start' . PHP_EOL;
    
        $this->deleteCatalog();
        echo 'Delete catalog, siteId: ' . $this->getSiteId() . PHP_EOL;
        
        $document   = $this->getDocumentHref($this->getHrefCategory());
        echo 'Get document, href: ' . $this->getHrefCategory() . PHP_EOL;

        $categories = $this->getCategories($document);
        echo 'Count$categories: ' . count($categories) . PHP_EOL;
        
        $this->parserCategories($categories);
        
        echo 'Finish' . PHP_EOL;
    }
    
    public function uploadPages(): void
    {
        echo 'Start' . PHP_EOL;
        
        $this->deletePage();
        echo 'Delete pages, siteId: ' . $this->getSiteId() . PHP_EOL;
        
        $catalogs = CatalogTable::find()
                                ->where(['isParser' => 0])
                                ->all();
        foreach ($catalogs as $catalog) {
            $document = $this->getDocumentHref($catalog->href);
            
            $pages = $this->getPages($document);
            foreach ($pages as $page) {
                $href = $this->getSiteName() . $page->attr('href');
                $name = trim($page->text());
                
                PageTable::saveData(
                    $href,
                    $name,
                    $catalog->id
                );
                echo 'Save page. Name: ' . $name . ', href: ' . $href . PHP_EOL;
            }
            $t           = CatalogTable::findOne($catalog->id);
            $t->isParser = 1;
            $t->save();
        }
        echo 'Finish' . PHP_EOL;
    }
    
    public function uploadProduct(): void
    {
        echo 'Start' . PHP_EOL;
        
        $this->deleteProduct();
        echo 'Delete products, siteId: ' . $this->getSiteId() . PHP_EOL;

        $pages = PageTable::find()
                           ->where(['isParser' => 0])
                           ->all();
        foreach ($pages as $page) {
            echo 'Find page (' . $page->id . '): ' . $page->href . PHP_EOL;
            /** @var Transaction $transaction * /
            $transaction = Yii::$app->dbParser->beginTransaction();
            try {
                $document    = $this->getDocumentHref($page->href);
                $name        = $this->getProductName($document);
                //$article     = self::getProductArticle($document);
                //$description = self::getProductDescription($document);
                ProductTable::saveData(
                    $name,
                    $page->id
                );
                $productId = ProductTable::find()->max('id');
                echo 'Save product. ID: ' . $productId . PHP_EOL;
                /*
                $specification = self::getProductSpecification($document);
                foreach ($specification as $item) {
                    AttributeTable::saveData(
                        strstr($item->text(), ':', true),
                        trim(strstr($item->text(), ':'), ':'),
                        $productId
                    );
                }
                $warranty = self::getWarranty($document);
                foreach ($warranty as $item) {
                    $str = trim($item->text());
                    if (mb_strstr($str, 'Гарантия', true) !== false) {
                        AttributeTable::saveData(
                            'Гарантия',
                            $str,
                            $productId
                        );
                        continue;
                    }
                }
                echo 'Save specification.' . PHP_EOL;
                * /
                $t           = PageTable::findOne($page->id);
                $t->isParser = 1;
                $t->save();
                
                $transaction->commit();
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw new \RuntimeException('Ошибка парсера: ' . $e->getMessage());
            }
        }
        echo 'Finish' . PHP_EOL;
    }
    
    protected function parserCategories(array $categories): void
    {
        foreach ($categories as $category) {
            $href = $this->getSiteName() . $category->attr('href');
            $name = trim($category->text());
        
            if ($pagination = $this->getPagination($href)) {
                foreach ($pagination as $page) {
                    CatalogTable::saveData($page, $name, '', $this->getSiteId());
                    echo 'Save category. Name: ' . $name . ', href: ' . $page . PHP_EOL;
                }
            } else {
                CatalogTable::saveData($href, $name, '', $this->getSiteId());
                echo 'Save category. Name: ' . $name . ', href: ' . $href . PHP_EOL;
            }
        }
    }
    

    
    private function deleteCatalog(): void
    {
        CatalogTable::deleteAll(['siteId' => $this->getSiteId()]);
    }
    
    private function deletePage(): void
    {
        $pageIds = PageTable::find()
                            ->select('p.id')
                            ->from(['p' => PageTable::tableName()])
                            ->leftJoin(['c' => CatalogTable::tableName()], 'p.catalogId=c.id')
                            ->leftJoin(['s' => SiteTable::tableName()], 'c.siteId=s.id')
                            ->where(['s.id' => $this->getSiteId()])
                            ->all();
    
        PageTable::deleteAll(['in', 'id', $pageIds]);
    }
    
    private function deleteProduct(): void
    {
        $productIds = ProductTable::find()
                                  ->select('pr.id')
                                  ->from(['pr' => ProductTable::tableName()])
                                  ->leftJoin(['p' => PageTable::tableName()], 'pr.pageId=pr.id')
                                  ->leftJoin(['c' => CatalogTable::tableName()], 'p.catalogId=c.id')
                                  ->leftJoin(['s' => SiteTable::tableName()], 'c.siteId=s.id')
                                  ->where(['s.id' => $this->getSiteId()])
                                  ->all();
    
        ProductTable::deleteAll(['in', 'id', $productIds]);
    }
    

    
    private function getDocumentFile(string $fileName): Document
    {
        return new Document($fileName, true);
    }
    
    private function getCategories(Document $document): array
    {
        try {
            $categories = $document->find($this->getStyleCategories());
        } catch (InvalidSelectorException $e) {
            throw new RuntimeException(sprintf(
                'Ошибка выбора категорий: %s',
                $e->getMessage()
            ));
        }
        
        if ( ! $categories) {
            throw new RuntimeException('Категории не найдены');
        }
        
        return $categories;
    }
    
    protected function getPagination(string $url, array &$result = []): array
    {
        $result = array_unique($result);
        
        try {
            $document = $this->getDocumentHref($url);
            
            $pagination = $document->find($this->getStylePagination());
            foreach ($pagination as $page) {
                $url = $this->getSiteName() . $page->attr('href');
                if ( ! in_array($url, $result)) {
                    $result[] = $url;
                    array_merge($result, $this->getPagination($url, $result));
                }
            }
        } catch (Throwable $e) {
            throw new RuntimeException(sprintf(
                'Ошибка разбора пагинации. URL: %s. %s',
                $url,
                $e->getMessage()
            ));
        }
        
        return array_unique($result);
    }
    
    private function getPages(Document $document): array
    {
        try {
            $items = $document->find($this->getStylePages());
        } catch (InvalidSelectorException $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка выбора страниц: %s',
                $e->getMessage()
            ));
        }
        
        return $items;
    }
    
    private function getProductName(Document $document): string
    {
        try {
            $name = $document->first($this->getStyleProductName())->text();
        } catch (\Throwable $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка определения наименования продукта: %s',
                $e->getMessage()
            ));
        }
        
        return $name;
    }
    
    /*
    
    
    
    

    

    

    

    
    private static function getProductArticle(Document $document): string
    {
        try {
            $article = trim(trim(trim($document->first('.product__code')->text()), 'Артикул:'));
        } catch (\Throwable $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка определения атрикула продукта: %s',
                $e->getMessage()
            ));
        }
        
        return $article;
    }
    
    private static function getProductDescription(Document $document): string
    {
        try {
            $d           = $document->first('.text-content.product-item-detail-tab-content');
            $description = '';
            if ($d) {
                $description = trim($d->innerHtml());
            }
        } catch (\Throwable $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка определения описания продукта: %s',
                $e->getMessage()
            ));
        }
        
        return $description;
    }
    
    private static function getProductSpecification(Document $document): array
    {
        try {
            $specification = $document->find('.product__desc ul li');
        } catch (\Throwable $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка определения описания продукта: %s',
                $e->getMessage()
            ));
        }
        
        return $specification;
    }
    
    private static function getWarranty(Document $document): array
    {
        try {
            $warranty = $document->find('.product__desc p');
        } catch (\Throwable $e) {
            throw new \RuntimeException(sprintf(
                'Ошибка определения гарантии продукта: %s',
                $e->getMessage()
            ));
        }
        
        return $warranty;
    }
    */
    
}
