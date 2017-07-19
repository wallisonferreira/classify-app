<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    protected $table = 'seens';

    protected $fillable = [
    	'user_id',
    	'title_id',
    ];

    public function titles()
    {
        return $this->hasMany('App\Title');
    } 
}
