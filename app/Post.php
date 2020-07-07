<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany('App\Category');
    }

    protected $fillable = [
        'title',
        'body',
    ];
}
