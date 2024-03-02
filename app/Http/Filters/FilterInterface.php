<?php

namespace App\Http\Filters;

use PhpParser\Builder;

interface FilterInterface
{
    public function apply(Builder $builder);

}
