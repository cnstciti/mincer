<?php declare(strict_types=1);

namespace frontend\models\parser_entity;

use frontend\models\tables\ParserEntityTable;

class LinkCatalogForm extends ParserEntityTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalogId'], 'required'],
        ];
    }

}
