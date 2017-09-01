<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Title extends Model
{
    use Eloquence;

    protected $table = 'titles';

    protected $fillable = [
        'title','trakt','tvdb','imdb','tmdb','year','slug','overview',
        'network','aired_episodes','poster','play_count','watcher_count',
    ];

    protected $searchableColumns = ['title', 'slug', 'network'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'lists');
    }
}
