<?php

namespace Stolentine\Macros\Mixins\Migrations\Type;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

/**
 * @mixin Blueprint
 * @property array|Fluent[] $commands
 */
class BlueprintMixin
{
    public function createType()
    {
        /**
         * @param array|string $columns
         * @param null $indexName
         * @return \Stolentine\Macros\Mixins\Migrations\Type\CreateTypeDefinition
         */
        return function ($typeName) {
            $command = new CreateTypeDefinition();
            $command->name = 'createType';
            $command->type = $typeName;

            $this->commands[] = $command;

            return $command;
        };
    }

    public function dropType()
    {
        /**
         * @param array|string $columns
         * @param null $indexName
         * @return \Stolentine\Macros\Mixins\Migrations\Type\DropTypeDefinition
         */
        return function ($typeName) {
            $command = new DropTypeDefinition();
            $command->name = 'dropType';
            $command->type = $typeName;

            $this->commands[] = $command;

            return $command;
        };
    }
}
