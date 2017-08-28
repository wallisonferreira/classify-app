<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List_ extends Model
{
    protected $table = 'lists';

    protected $fillable = [
    	'user_id',
    	'title_id',
    ];

    public function titles()
    {
        return $this->hasMany('App\Title');
    } 
}
