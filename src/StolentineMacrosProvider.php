<?php

namespace Stolentine\Macros;

use Stolentine\Macros\Mixins\BuilderMixin;
use Stolentine\Macros\Mixins\CollectionsMixin;
use Stolentine\Macros\Mixins\Migrations\MigrationsMacrosProvider;
use Stolentine\Macros\Mixins\RouteMixin;
use Stolentine\Macros\Mixins\RulesMixin;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

class StolentineMacrosProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        Builder::mixin(new BuilderMixin());
        Rule::mixin(new RulesMixin());
        Router::mixin(new RouteMixin());
        Collection::mixin(new CollectionsMixin());

        app(MigrationsMacrosProvider::class)->boot();
    }
}
