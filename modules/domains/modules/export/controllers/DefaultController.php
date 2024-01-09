<?php declare(strict_types = 1);

namespace modules\domains\modules\export\controllers;

use modules\domains\modules\export\models\ExportTemplateService;
use yii\web\Controller;

class DefaultController extends Controller
{
    
    public function actionTemplate(int $catalogId): string
    {
        return $this->render('template', [
            'title'    => 'Экспорт шаблона',
            'filePath' => ExportTemplateService::getTemplate($catalogId),
        ]);
    }
    
}
