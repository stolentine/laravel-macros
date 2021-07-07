<?php

namespace Stolentine\Macros\Mixins;

use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */
class BuilderMixin
{
    /**
     * Add to where: AND "$column" ILIKE '%$value%'.
     * @param $column
     * @param $value
     * @param string $boolean
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::whereIlike()
     */
    public function whereIlike()
    {
        /**
         * Add to where: AND "$column" ILIKE '%$value%'.
         * @param $column
         * @param $value
         * @param string $boolean
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::whereIlike()
         */
        return function ($column, $value, $boolean = 'and') {
            $this->where($column, 'ilike', "%$value%", $boolean);

            return $this;
        };
    }

    /**
     * Add to where: OR "$column" ILIKE '%$value%'.
     * @param $column
     * @param $value
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::orWhereIlike()
     */
    public function orWhereIlike()
    {
        /**
         * Add to where: OR "$column" ILIKE '%$value%'.
         * @param $column
         * @param $value
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::orWhereIlike()
         */
        return function ($column, $value) {
            return $this->whereIlike($column, $value, 'or');
        };
    }

    /**
     * Add to where:
     * AND ("$column" ILIKE '%$value[0]%' OR "$column" ILIKE '%$value[1]%' OR ...).
     * @param string $column
     * @param array $values
     * @param string $boolean
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::whereIlikeIn()
     */
    public function whereIlikeIn()
    {
        /**
         * Add to where:
         * AND ("$column" ILIKE '%$value[0]%' OR "$column" ILIKE '%$value[1]%' OR ...).
         * @param string $column
         * @param array $values
         * @param string $boolean
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::whereIlikeIn()
         */
        return function ($column, array $values, $boolean = 'and') {
            $this->where(function ($q) use ($column, $values) {
                foreach ($values as $value) {
                    $q->orWhereIlike($column, $value);
                }
            }, null, null, $boolean);

            return $this;
        };
    }

    /**
     * Add to where: OR ("$column" ILIKE '%$value[0]%' OR "$column" ILIKE '%$value[1]%' OR ...).
     * @param string $column
     * @param array $values
     * @param string $boolean
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::orWhereIlikeIn()
     */
    public function orWhereIlikeIn()
    {
        /**
         * Add to where: OR ("$column" ILIKE '%$value[0]%' OR "$column" ILIKE '%$value[1]%' OR ...).
         * @param string $column
         * @param array $values
         * @param string $boolean
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::orWhereIlikeIn()
         */
        return function ($column, array $values) {
            return $this->whereIlikeIn($column, $values, 'or');
        };
    }

    /**
     * Add ORDER BY column IN (value0, value1, value2, ...).
     * @param string $column
     * @param array $values
     * @param string $direction
     * @param bool $not
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::orderByIn()
     */
    public function orderByIn()
    {
        /**
         * Add ORDER BY column IN (value0, value1, value2, ...).
         * @param string $column
         * @param array $values
         * @param string $direction
         * @param bool $not
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::orderByIn()
         */
        return function (string $column, array $values, $direction = 'ASC', $not = false) {
            $prepare = implode(', ', array_fill(0, count($values), '?'));
            $not = $not ? 'NOT IN' : 'IN';

            /** @var \Illuminate\Database\Query\Builder $this */
            return $this->orderByRaw($column." $not ($prepare) $direction", $values);
        };
    }

    /**
     * Add ORDER BY column IN (value0, value1, value2, ...) DESC.
     * @param string $column
     * @param array $values
     * @param string $direction
     * @param bool $not
     * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
     *
     * @uses \Stolentine\Macros\Mixins\BuilderMixin::orderByIn()
     */
    public function orderByInDesc()
    {
        /**
         * Add ORDER BY column IN (value0, value1, value2, ...) DESC.
         * @param string $column
         * @param array $values
         * @param string $direction
         * @param bool $not
         * @return static|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder
         *
         * @uses \Stolentine\Macros\Mixins\BuilderMixin::orderByIn()
         */
        return function (string $column, array $values, $not = false) {
            /** @var \Illuminate\Database\Query\Builder $this */
            return $this->orderByIn($column, $values, 'DESC', $not);
        };
    }

    public function updateToSql()
    {
        /**
         * @param array $values
         */
        return function (array $values) {
            return $this->getGrammar()->compileUpdate($this, $values);
        };
    }
}
