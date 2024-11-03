<?php declare(strict_types = 1);

namespace frontend\models\parser_simple_type;

use frontend\models\tables\ParserValueTable;

class LinkEnumForm extends ParserValueTable
{
    
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['dictionaryContentId'], 'required'],
        ];
    }

}
