<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'titles';

    protected $fillable = [
        'title',
        'trakt',
        'tvdb',
        'imdb',
        'tmdb',
        'year',
        'slug',
        'overview',
        'network',
        'aired_episodes',
        'poster',
        'play_count',
        'watcher_count',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'lists');
    }
}
