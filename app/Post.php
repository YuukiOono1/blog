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

    // 中間テーブルを通してUserテーブルにリレーション
    public function favorites(): BelongsToMany
    {
        // 第一引数に関係先のテーブル、第二引数に中間テーブル（省略するとpost_userテーブル)
        return $this->belongsToMany('App\User', 'favorites');
    }

    // お気に入りしているか判定
    // $post->isLikedBy(Auth::user())
    public function isFavoritedBy(?User $user): bool // null許容
    {
        return $user
            ? (bool)$this->favorites->where('id', $user->id)->count()
            : false;
    }

    protected $fillable = [
        'title',
        'body',
    ];
}
