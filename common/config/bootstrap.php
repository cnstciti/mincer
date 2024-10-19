<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@modules', dirname(dirname(__DIR__)) . '/modules');
Yii::setAlias('@export', dirname(dirname(__DIR__)) . '/common/export');
Yii::setAlias('@import', dirname(dirname(__DIR__)) . '/common/import');
Yii::setAlias('@parser', dirname(dirname(__DIR__)) . '/common/parser');
Yii::setAlias('@pictures', dirname(dirname(__DIR__)) . '/common/pictures');
Yii::setAlias('@storageFolderMincerImg', dirname(dirname(__DIR__)) . '/frontend/web/data');
Yii::setAlias('@storageWebMincerImg', 'http://mincer.local/data');
Yii::setAlias('@wmData', dirname(dirname(__DIR__)) . '\modules\domains\modules\image_type\models\image');

Yii::setAlias('@parserMegamarket', dirname(dirname(__DIR__)) . '/parser_data/megamarket.ru');

