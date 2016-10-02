<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Notification extends Model 
{
    use SyncsWithFirebase;

    protected $fillable = ['post_auther', 'reply_auther'];

    protected $visible = ['id', 'post_auther', 'reply_auther'];    
}
