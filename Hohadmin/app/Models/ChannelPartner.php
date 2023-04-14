<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelPartner extends Model
{
    use HasFactory;

    protected $table = 'channel_partner';

    protected $fillable = ['cp_name','email_id','mobile','address','campany_name','gstno','rerano','company_address','acc_no','ifsc','bank_name','cp_id','rera_certificate_path','gst_certificate_path','sm_id','pan_no'];

  
}
