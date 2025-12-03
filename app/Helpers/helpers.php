<?php

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

if (! function_exists('api')) {
    function api(
        $message,
        $data = null,
        $status = 200
    ) {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'error' => null,
        ];

        if ($data instanceof LengthAwarePaginator) {
            $response['pagination'] = [
                'total' => $data->total(),
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ];
            $response['data'] = $data->items();
        } elseif ($data instanceof ResourceCollection) {
            if ($data->resource instanceof LengthAwarePaginator) {
                $response['pagination'] = [
                    'total' => $data->total(),
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                ];

                $response['data'] = $data->resource->items();
            } else {
                $response['data'] = $data->toArray(request());
            }
        }

        return Response::json($response, $status);
    }
}

if (! function_exists('error')) {
    function error(
        $message = 'Something went wrong!',
        $error = null,
        $status = 400
    ) {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => null,
            'error' => $error,
        ];

        return Response::json($response, $status);
    }
}

if (! function_exists('make_username')) {
    function make_username(string $value)
    {
        return strtolower(trim(str_replace(' ', '', $value)));
    }
}
