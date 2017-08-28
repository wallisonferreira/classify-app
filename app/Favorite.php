<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
    	'user_id',
    	'title_id',
    ];

    public function titles()
    {
        return $this->hasMany('App\Title');
    }
}
