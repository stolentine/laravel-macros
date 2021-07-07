<?php

namespace Stolentine\Macros\Mixins\Migrations\AddColumnRaw;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Grammars\Grammar;

/**
 * @mixin Grammar
 */
class GrammarMixin
{
    public function typeRaw()
    {
        /**
         * @param Fluent $column
         * @return mixed
         */
        return function (Fluent $column) {
            return $column->get('raw_type');
        };
    }
}
