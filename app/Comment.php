<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
    	'user_id',
    	'title_id',
        'texto',
    ];

    protected $with = ['user'];

    public function titles()
    {
        return $this->hasMany('App\Title');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
