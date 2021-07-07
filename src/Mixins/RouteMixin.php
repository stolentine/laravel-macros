<?php

namespace Stolentine\Macros\Mixins;

class RouteMixin
{
    public function resourceId()
    {
        /**
         * Создает ресурс с параметром ID.
         * @param $name
         * @param $controller
         * @param $options
         * @return \Stolentine\Macros\Mixins\RouteMixin|\Illuminate\Routing\PendingResourceRegistration
         *
         * @uses \Stolentine\Macros\Mixins\RouteMixin::resourceId()
         */
        return function ($name, $controller, $options = []) {
            return \Illuminate\Routing\Router::resource($name, $controller, $options)
                ->parameters([$name => 'id']);
        };
    }
}
