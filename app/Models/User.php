<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table='users';
    
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }
        if ($this->first_name) {
            return $this->first_name;
        }
        return null;
    }
    
    public function posts()
    {
        return $this->hasMany('App\Models\Post','user_id');
    }

    public function getNameOrUsername()
    {
        return $this->getName() ? : $this->username;
    }
    
    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }
    public function getAvatarUrl()
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash?d=mm&s=50";
    }
   
}
