<?php

namespace Stolentine\Macros\Mixins\Migrations\AddColumnRaw;

use Illuminate\Database\Schema\Blueprint;

/**
 * @mixin Blueprint
 */
class BlueprintMixin
{
    public function addColumnRaw()
    {
        /**
         * @param $rawType
         * @param $name
         * @return \Illuminate\Database\Schema\ColumnDefinition
         */
        return function ($rawType, $name) {
            return $this->addColumn('raw', $name, ['raw_type' => $rawType]);
        };
    }
}
