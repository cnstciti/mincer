<?php declare(strict_types = 1);

namespace modules\domains\modules\import\controllers;

use Exception;
use modules\domains\modules\import\models\ImportForm;
use modules\domains\modules\import\models\ImportService;
use Throwable;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class DefaultController extends Controller
{
    
    /**
     * @return string
     * @throws Throwable
     */
    public function actionIndex(): string
    {
        $model = $this->getImportForm();
    
        if ($this->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
        
            if ($model->file && $model->validate()) {
                ImportService::fromJson($model->file->tempName, $model->isTruncate);
            
                return $this->render('finish', [
                    'title' => ImportService::getTitle(),
                ]);
            }
        }
    
        return $this->render('form', [
            'title' => ImportService::getTitle(),
            'model' => $model,
        ]);
    }
    
    /**
     * @return mixed
     * @throws Exception
     */
    private function getImportForm(): ImportForm
    {
        try {
            return Yii::$container->invoke(
                [
                    new ImportService,
                    'getImportForm',
                ]
            );
        } catch (Throwable $e) {
            throw new Exception(sprintf(
                'Ошибка вызова ImportService->getImportForm: %s',
                $e->getMessage()
            ));
        }
    }
    
}
