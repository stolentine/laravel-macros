<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomUnique;

use Illuminate\Support\Fluent;

class UniqueKeyDefinition extends Fluent
{
    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $operator ??= '=';

        $whereGrammar = new WhereGrammar();
        $whereGrammar->column = $column;
        $whereGrammar->operator = $operator;
        $whereGrammar->value = $value;
        $whereGrammar->boolean = $boolean;

        $this->attributes['where'][] = $whereGrammar;

        return $this;
    }

    /**
     * @param $column
     * @param string $boolean
     * @return $this
     */
    public function whereIsNull($column, $boolean = 'and')
    {
        return $this->where($column, 'is', null, $boolean);
    }

    /**
     * @param string $boolean
     * @return $this
     */
    public function whereDeletedAtIsNull($boolean = 'and')
    {
        return $this->whereIsNull('deleted_at');
    }
}
