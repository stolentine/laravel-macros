<?php

namespace Stolentine\Macros\Mixins\Migrations\Type;

use Illuminate\Support\Fluent;

/**
 * @property string name
 * @property string type
 *
 * @property string ifExists
 * @method  $this ifExists()
 */
class DropTypeDefinition extends Fluent
{
}
