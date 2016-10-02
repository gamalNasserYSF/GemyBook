<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model 
{
    protected $table='replies';
    
    protected $fillable = [
        'body'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    
}
