<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiService
{
    protected $per_page = 15;

    protected $page = 1;

    public function makeApiResponse(Builder $query, Request $request): LengthAwarePaginator
    {
        $query = $this->applyPagination($query, $request);

        return $query;
    }

    public function applyPagination(Builder $query, $request): LengthAwarePaginator
    {
        $perPage = $request->per_page;
        $page = $request->page;

        return $query->paginate(
            $perPage ?? $this->per_page,
            ['*'],
            'page',
            $page ?? $this->page
        );
    }
}
