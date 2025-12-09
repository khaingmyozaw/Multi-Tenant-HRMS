<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected $fillables = ['uuid'];

    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
