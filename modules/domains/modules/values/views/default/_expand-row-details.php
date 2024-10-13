<?php declare(strict_types=1);

use modules\domains\modules\value\models\ImgTypeDataView;
use modules\domains\modules\value\models\ValueImageService;
use yii\helpers\Html;

/**
 * @var ImgTypeDataView $model
 */

$storage = Yii::getAlias('@storageWebMincerImg');
//$storage = (new ValueImageService)->getStorageMincerImg();
?>
<div class="row">
    <div class="col-6">
        <?= Html::img($storage .'/'. $model->file) ?>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-4">
                Высота
            </div>
            <div class="col">
                <?= $model->height ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Ширина
            </div>
            <div class="col">
                <?= $model->width ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Размер
            </div>
            <div class="col">
                <?= $model->size ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                Расширение
            </div>
            <div class="col">
                <?= $model->ext ?>
            </div>
        </div>
    </div>
</div>
