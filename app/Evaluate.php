<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    protected $table = 'evaluates';

    protected $fillable = [
    	'user_id',
    	'title_id',
        'nota',
    ];

    public function titles()
    {
        return $this->hasOne('App\Title');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
