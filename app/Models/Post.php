<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model 
{
    protected $table='posts';
    
    protected $fillable = [
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function replies()
    {
    	return $this->hasMany('App\Models\Post','parent_id');
    }

    public function scopeNotReply($query)
    {
    	return $query->whereNull('parent_id');
    }

}
