<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Movie extends Model
{
    /**
      * The protected attributes
      *
      * @var array
      */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $casts = [
        'id'               => 'integer',
        'image'            => 'string',
        'description'      => 'string',
        'director'         => 'string'
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function hasReview(): bool
    {
        return $this->review()->whereUserId(Auth::user()->id)->exists();
    }
}
