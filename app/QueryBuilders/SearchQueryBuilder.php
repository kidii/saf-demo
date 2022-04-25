<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class SearchQueryBuilder extends Builder {
    /**
     * Search filters.
     */
    public function searchByName(array $filters)
    {
        return $this->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}