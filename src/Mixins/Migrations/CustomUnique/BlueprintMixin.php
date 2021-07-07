<?php

namespace Stolentine\Macros\Mixins\Migrations\CustomUnique;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Fluent;

/**
 * @mixin Blueprint
 * @property array|Fluent[] $commands
 */
class BlueprintMixin
{
    public function customUnique()
    {
        /**
         * @param array|string $columns
         * @param null $indexName
         * @return \Stolentine\Macros\Mixins\Migrations\CustomUnique\UniqueKeyDefinition
         */
        return function ($columns, $indexName = null) {
            $columns = (array) $columns;

            $indexName ??= $this->createIndexName('custom_unique', $columns);

            $command = new UniqueKeyDefinition([
                'name' => 'customUnique',
                'index' => $indexName,
                'columns' => $columns,
            ]);

            $this->commands[] = $command;

            return $command;
        };
    }
}
