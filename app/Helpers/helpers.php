<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

if (! function_exists('api')) {
    function api(
        $message,
        $data = null,
        $status = 200,
        $is_paginated = false
    ) {
        $meta = [];
        if ($is_paginated && $data instanceof LengthAwarePaginator) {
            $meta = [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ];
            $data = $data->items();
        }
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'error' => null,
        ];

        if ($meta) {
            $response['pagination'] = $meta;
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
    function make_username(String $value) {
        return strtolower(trim(str_replace(' ', '', $value)));
    }
}
