<?php

namespace Stolentine\Macros\Mixins\Migrations;

use DB;
use Illuminate\Database\Query\Builder;

/**
 * @property Builder queryBuilder
 * @mixin \Illuminate\Support\Fluent
 */
trait TWithQueryBuilder
{
    public function __construct($attributes = [])
    {
        $attributes['queryBuilder'] = DB::table('fake');
        parent::__construct($attributes);
    }

    public function getWhereSql()
    {
        $querySql = $this->getQueryBuilder()->toSql();
        $whereSql = substr($querySql, strpos($querySql, 'where') + 6);

        $explodeWhere = explode('?', $whereSql);
        $bindings = $this->getQueryBuilder()->getRawBindings()['where'];

        if (count($explodeWhere) !== count($bindings) + 1) {
            throw new \Exception('invalid bindings QUERY: '.$whereSql.' BINDINGS: '.implode(', ', $bindings));
        }

        $whereBind = [];
        while (count($bindings)) {
            $whereBind[] = array_shift($explodeWhere);

            $binding = array_shift($bindings);
            if (is_string($binding)) {
                $whereBind[] = "'".$binding."'";
            } elseif (is_bool($binding)) {
                $whereBind[] = $binding ? 'true' : 'false';
            } else {
                $whereBind[] = $binding;
            }
        }
        $whereBind[] = array_shift($explodeWhere);

        return implode('', $whereBind);
    }

    private function where(\Closure $closure)
    {
        $closure($this->getQueryBuilder());

        return $this;
    }

    private function getQueryBuilder(): Builder
    {
        return $this->queryBuilder;
    }
}
