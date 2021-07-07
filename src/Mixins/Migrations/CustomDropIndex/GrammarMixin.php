<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomDropIndex;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;

/**
 * @mixin Grammar
 */
class GrammarMixin
{
    public function compileCustomDropIndex()
    {
        /**
         * @param Fluent $column
         * @return mixed
         */
        return function (Blueprint $blueprint, Fluent $command) {
            $sql = 'drop index';

            if ($command->ifExists) {
                $sql .= ' if exists';
            }

            $sql .= " {$this->wrap($command->index)}";

            return $sql;
        };
    }
}
