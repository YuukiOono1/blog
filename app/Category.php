<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    public function post(): BelongsToMany
    {
        return $this->belongsToMany('App\Post');
    }

    protected $fillable = [
        'name',
    ];
}
