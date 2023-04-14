<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesManager extends Model
{
    use HasFactory;

    protected $table = 'sales_manager';

    protected $fillable = ['sm_name','email_id','mobile','address','employee_id'];

  
}
