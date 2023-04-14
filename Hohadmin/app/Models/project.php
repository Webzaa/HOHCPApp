<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $table = 'project';

    protected $fillable = ['project_name','configuration','price','city_id','carpet_area','connectivity','no_of_towers','no_of_units','possession_date','rera_certificate_no','project_offers','rera_certificate_path','hero_image_path','amenities_id','project_type_id','campaign_key','lead_category','integrations','about_project','Pid'];

    
}
