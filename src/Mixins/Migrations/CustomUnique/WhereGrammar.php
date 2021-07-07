<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomUnique;

class WhereGrammar
{
    public string $column;
    public string $operator = '=';
    public $value = null;
    public string $boolean = 'and';
}
