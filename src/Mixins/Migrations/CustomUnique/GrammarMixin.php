<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomUnique;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;

/**
 * @mixin Grammar
 */
class GrammarMixin
{
    public function compileCustomUnique()
    {
        /**
         * @param Fluent $column
         * @return mixed
         */
        return function (Blueprint $blueprint, Fluent $command) {
            $sql = sprintf('create unique index %s on %s (%s)',
                $this->wrap($command->index),
                $this->wrapTable($blueprint),
                $this->columnize($command->columns)
            );

            /** @var WhereGrammar[] $whereGrammars */
            $whereGrammars = $command->where ?? [];
            if (!empty($whereGrammars)) {
                $sql .= ' where';

                foreach ($whereGrammars as $key => $where) {
                    $whereRaw = ' ';

                    if ($key !== 0) {
                        $whereRaw .= $where->boolean.' ';
                    }

                    $whereRaw .= $where->column.' '.$where->operator.' ';

                    if ($where->value === null) {
                        $whereRaw .= 'null';
                    } elseif (is_string($where->value)) {
                        $whereRaw .= "'".$where->value."'";
                    } elseif (is_bool($where->value)) {
                        $whereRaw .= $where->value ? 'true' : 'false';
                    } else {
                        $whereRaw .= $where->value;
                    }

                    $sql .= $whereRaw;
                }
            }

            return $sql;
        };
    }
}
