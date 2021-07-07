<?php

namespace Stolentine\Macros\Mixins;

use Illuminate\Support\Collection;

/**
 * @mixin Collection
 * @property array items
 */
class CollectionsMixin
{
    public function undot()
    {
        /**
         * Обратная операция хэлпера dot().
         * @return \Stolentine\Macros\Mixins\CollectionsMixin|\Illuminate\Support\Collection
         *
         * @uses app/Macros/macros.php
         */
        return function () {
            $this->items = array_undot($this->items);

            return $this;
        };
    }
}
