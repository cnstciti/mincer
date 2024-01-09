<?php declare(strict_types = 1);

namespace modules\domains\modules\import\models;

use modules\domains\modules\entity\models\EntityService;
use modules\domains\modules\value\models\EavService;
use modules\domains\modules\value\models\ValueFloatService;
use modules\domains\modules\value\models\ValueIntService;
use modules\domains\modules\value\models\ValueService;
use modules\domains\modules\value\models\ValueSetService;
use modules\domains\modules\value\models\ValueStringService;
use modules\domains\modules\value\models\ValueTextService;

class ImportCleanupData
{
    
    /**
     * Очистка таблиц
     *
     * @throws \yii\db\Exception
     */
    public static function truncate()
    {
        EntityService::truncate();
        ValueService::truncate();
        EavService::truncate();
        ValueSetService::truncate();
        ValueIntService::truncate();
        ValueFloatService::truncate();
        ValueStringService::truncate();
        ValueTextService::truncate();
    }
    
}
