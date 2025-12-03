<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiService
{
    protected $per_page = 15;

    protected $page = 1;

    /**
     * Apply search value to the query
     * 
     * @var Builder $query
     * @var Request $request
     * 
     * @return LengthAwarePaginator
     */
    public function makeApiResponse(Builder $query, Request $request): LengthAwarePaginator
    {
        $query = $this->applySearch($query, $request);
        $query = $this->applyPagination($query, $request);

        return $query;
    }

    /**
     * Apply search value to the query
     * 
     * @var Builder $query
     * @var Request $request
     * 
     * @return Builder
     */
    public function applySearch(Builder $query, Request $request): Builder
    {
        return $query->where('name', 'ILIKE', "%{$request->search}%");
    }

    /**
     * Apply pagination to the query
     * 
     * @var Builder $query
     * @var Request $request
     * 
     * @return LengthAwarePaginator
     */
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
