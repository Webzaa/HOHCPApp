<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';

    protected $fillable = ['title','msg_body','user_id'];
    /**
     * Get the user that owns the phone.
     */
   
}
