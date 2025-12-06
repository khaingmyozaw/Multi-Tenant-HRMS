<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class ApiService
{
    /**
     * Base API resource for CRUD operations
     *
     * @method LengthAwarePaginator index(Request $request) Get a list of the resource
     * @method Model show(int|string $id) Get the specific resource
     * @method Model store(array $data) Store a newly data
     * @method bool update(array $data) Update the provide data
     * @method bool delete(int|string $id) Delete the specific resource
     */

    /** @var class-string<TModel> */
    protected string $model;

    protected function query(): Builder
    {
        return $this->model::query();
    }

    public function index(Request $request): LengthAwarePaginator
    {
        $query = $this->query();

        return $this->makeApiResponse($query, $request);
    }

    public function store(array $data): Model
    {
        return $this->model::create($data);
    }

    public function show(int|string $id): Model
    {
        return $this->model::findOrFail($id);
    }

    public function update(array $validated, int|string|Model $data): Model
    {
        if (! $data instanceof Model) {
            $data = $this->show($data);
        }

        $data->update($validated);

        return $data;
    }

    public function delete(int|string $data): bool
    {
        if (! $data instanceof Model) {
            $data = $this->show($data);
        }

        return $data->delete();
    }

    /**
     * Apply search value to the query
     *
     * @var Builder
     * @var Request
     */
    public function makeApiResponse(Builder $query, Request $request): LengthAwarePaginator
    {
        if ($request->filled('search')) {
            $query = $this->applySearch($query, $request);
        }

        if ($request->filled('sort_by') || $request->filled('sort_direction')) {
            $query = $this->applySorting($query, $request);
        }

        $query = $this->applyPagination($query, $request);

        return $query;
    }

    /**
     * Apply search value to the query
     *
     * @var Builder
     * @var Request
     */
    public function applySearch(Builder $query, Request $request): Builder
    {
        return $query->where('name', 'ILIKE', "%{$request->search}%");
    }

    /**
     * Apply sorting value to the query
     *
     * @var Builder
     * @var Request
     */
    public function applySorting(Builder $query, Request $request): Builder
    {
        return $query->orderBy($request->sort_by ?? 'id', $request->sort_direction ?? 'asc');
    }

    /**
     * Apply pagination to the query
     *
     * @var Builder
     * @var Request
     */
    public function applyPagination(Builder $query, $request): LengthAwarePaginator
    {
        $perPage = $request->per_page;
        $page = $request->page;

        return $query->paginate(
            $perPage ?? 10,
            ['*'],
            'page',
            $page ?? 1
        );
    }
}
