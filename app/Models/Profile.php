<?php

namespace App\Models;

use App\GenderEnum;
use App\RelationshipEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'dob',
        'gender', 'relationship',
        'nationality', 'race',
        'address', 'phone',
        'email', 'education',
        'image', 'joined_date',
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<enum, enum>
     */
    protected function casts()
    {
        return [
            'gender' => GenderEnum::cases(),
            'relationship' => RelationshipEnum::cases(),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
