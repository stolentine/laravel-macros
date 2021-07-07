<?php

namespace Stolentine\Macros\Mixins\Migrations\Type;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;

/**
 * @mixin Grammar
 */
class GrammarMixin
{
    public function compileCreateType()
    {
        /**
         * @param Fluent $column
         * @return mixed
         */
        return function (Blueprint $blueprint, CreateTypeDefinition $command) {
            $as = '';
            if ($command->enum) {
                $quoteValues = array_map(
                    fn ($value) => $this->quoteString($value),
                    $command->enum
                );
                $quoteValues = implode(', ', $quoteValues);

                $as = sprintf('as enum (%s)',
                    $quoteValues
                );
            }

            return sprintf('create type %s %s',
                $this->wrap($command->type),
                $as
            );
        };
    }

    public function compileDropType()
    {
        /**
         * @param Fluent $column
         * @return mixed
         */
        return function (Blueprint $blueprint, DropTypeDefinition $command) {
            return [sprintf('drop type %s %s',
                ($command->ifExists ? 'if exists' : ''),
                $this->wrap($command->type),
            )];
        };
    }
}
