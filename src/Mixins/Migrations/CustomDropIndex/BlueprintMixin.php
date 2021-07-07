<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomDropIndex;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

/**
 * @mixin Blueprint
 * @property array|Fluent[] $commands
 */
class BlueprintMixin
{
    public function customDropIndex()
    {
        /**
         * @param array|string $index
         * @param string $type
         * @return \Stolentine\Macros\Mixins\Migrations\CustomDropIndex\DropIndexDefinition
         */
        return function ($index, $type = 'index') {
            $command = new DropIndexDefinition(
                $this->dropIndexCommand('customDropIndex', $type, $index)->getAttributes()
            );

            $this->commands[count($this->commands) - 1] = $command;

            return $command;
        };
    }
}
