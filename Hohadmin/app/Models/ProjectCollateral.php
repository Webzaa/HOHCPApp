<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCollateral extends Model
{
    use HasFactory;

    protected $table = 'project_collateral';

    protected $fillable = ['project_id','collateral_type'];
}
