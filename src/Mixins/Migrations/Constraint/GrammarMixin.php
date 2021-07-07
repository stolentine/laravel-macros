<?php

namespace Stolentine\Macros\Mixins\Migrations\Constraint;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;

/**
 * @mixin Grammar
 */
class GrammarMixin
{
    public function compileAddConstraint()
    {
        /**
         * @param Blueprint $blueprint
         * @param ConstraintDefinition|Fluent $command
         * @return mixed
         */
        return function (Blueprint $blueprint, Fluent $command) {
            $sql = sprintf('ALTER TABLE %s
                ADD CONSTRAINT %s
                CHECK (%s);',
                $blueprint->getTable(),
                $this->wrap($command->constraintName),
                $command->getWhereSql()
            );

            return $sql;
        };
    }

    public function compileDropConstraintt()
    {
        /**
         * @param Blueprint $blueprint
         * @param DropConstraintDefinition|Fluent $command
         * @return mixed
         */
        return function (Blueprint $blueprint, Fluent $command) {
            $sql = sprintf('ALTER TABLE %s
                DROP CONSTRAINT %s %s;',
                $blueprint->getTable(),
                $command->getIfExistsSql(),
                $this->wrap($command->constraintName)
            );

            return $sql;
        };
    }
}
