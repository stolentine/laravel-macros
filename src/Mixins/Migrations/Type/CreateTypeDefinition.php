<?php

namespace Stolentine\Macros\Mixins\Migrations\Type;

use Illuminate\Support\Fluent;

/**
 * @property string name
 * @property string type
 *
 * @property array enum
 * @method $this enum(array $enum)
 */
class CreateTypeDefinition extends Fluent
{
}
