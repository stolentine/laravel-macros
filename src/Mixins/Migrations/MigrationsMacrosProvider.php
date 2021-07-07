<?php

namespace Stolentine\Macros\Mixins\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;

class MigrationsMacrosProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Blueprint::mixin(new \Stolentine\Macros\Mixins\Migrations\AddColumnRaw\BlueprintMixin());
        Grammar::mixin(new \Stolentine\Macros\Mixins\Migrations\CustomDropIndex\GrammarMixin());

        Blueprint::mixin(new \Stolentine\Macros\Mixins\Migrations\CustomUnique\BlueprintMixin());
        Grammar::mixin(new \Stolentine\Macros\Mixins\Migrations\AddColumnRaw\GrammarMixin());

        Blueprint::mixin(new \Stolentine\Macros\Mixins\Migrations\CustomDropIndex\BlueprintMixin());
        Grammar::mixin(new \Stolentine\Macros\Mixins\Migrations\CustomUnique\GrammarMixin());

        Blueprint::mixin(new \Stolentine\Macros\Mixins\Migrations\Type\BlueprintMixin());
        Grammar::mixin(new \Stolentine\Macros\Mixins\Migrations\Type\GrammarMixin());

        Blueprint::mixin(new \Stolentine\Macros\Mixins\Migrations\Constraint\BlueprintMixin());
        Grammar::mixin(new \Stolentine\Macros\Mixins\Migrations\Constraint\GrammarMixin());
    }
}
