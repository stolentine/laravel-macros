<?php

namespace Stolentine\Macros\Mixins\Migrations\Constraint;

use Stolentine\Macros\Mixins\Migrations\TIfExists;
use Illuminate\Support\Fluent;

class DropConstraintDefinition extends Fluent
{
    use TIfExists;
}
