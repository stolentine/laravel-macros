<?php

namespace Stolentine\Macros\Mixins\Migrations\Constraint;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

/**
 * @property string prefix
 * @property string table
 *
 * @mixin Blueprint
 * @property array|Fluent[] $commands
 */
class BlueprintMixin
{
    public function addConstraint()
    {
        /**
         * @param string|array $constraintName
         * @return \Stolentine\Macros\Mixins\Migrations\Constraint\ConstraintDefinition
         */
        return function ($constraintName) {
            if (is_array($constraintName)) {
                $constraintName = $this->createConstraintName($constraintName);
            }

            $command = new ConstraintDefinition();
            $command->name = 'addConstraint';
            $command->constraintName = $constraintName;

            $this->commands[] = $command;

            return $command;
        };
    }

    public function dropConstraint()
    {
        /**
         * @param string|array $constraintName
         * @return \Stolentine\Macros\Mixins\Migrations\Constraint\ConstraintDefinition
         */
        return function ($constraintName) {
            if (is_array($constraintName)) {
                $constraintName = $this->createConstraintName($constraintName);
            }

            $command = new ConstraintDefinition();
            $command->name = 'dropConstraint';
            $command->constraintName = $constraintName;

            $this->commands[] = $command;

            return $command;
        };
    }

    /**
     * @param array $columns
     * @return \Closure
     */
    protected function createConstraintName()
    {
        return function (array $columns) {
            return strtolower($this->prefix.$this->table.'_'.implode('_', $columns).'_check');
        };
    }
}
