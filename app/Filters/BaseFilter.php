<?php

declare(strict_types=1);

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BaseFilter
{
    public function apply(Builder $query, array $filters): Builder
    {
        return $query
            ->when(!empty($filters['created_at']), fn($q) => $q->where('created_at', 'like', $filters['created_at'] . '%'))
            ->when(!empty($filters['created_at_from']), fn($q) => $q->where('created_at', '>=', $filters['created_at_from']))
            ->when(!empty($filters['created_at_to']), fn($q) => $q->where('created_at', '<=', $filters['created_at_to']))
            ->orderByDesc('created_at');
    }
}
