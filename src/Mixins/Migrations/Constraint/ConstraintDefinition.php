<?php

namespace Stolentine\Macros\Mixins\Migrations\Constraint;

use Closure;
use Stolentine\Macros\Mixins\Migrations\TWithQueryBuilder;
use Illuminate\Support\Fluent;

/**
 * @property string name
 * @property string columns
 * @property string constraintName
 */
class ConstraintDefinition extends Fluent
{
    use TWithQueryBuilder;

    /**
     * @param null $closure
     * @return ConstraintDefinition|\Illuminate\Database\Query\Builder
     */
    public function check($closure = null)
    {
        if ($closure instanceof Closure) {
            return $this->where($closure);
        } elseif (is_string($closure)) {
            $this->getQueryBuilder()->whereRaw($closure);

            return $this;
        }

        throw new \Exception('Invalid check');
    }
}
