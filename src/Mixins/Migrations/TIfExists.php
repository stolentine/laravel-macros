<?php

namespace Stolentine\Macros\Mixins\Migrations;

/**
 * @property bool ifExists
 * @method $this ifExists()
 * @mixin \Illuminate\Support\Fluent
 */
trait TIfExists
{
    public function getIfExistsSql()
    {
        return $this->ifExists ? ' if exists ' : '';
    }
}
