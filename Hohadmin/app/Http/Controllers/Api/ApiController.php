<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\ChannelPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;
use File;

class ApiController extends Controller
{
    public $successStatus = 200;
    
    // Function to get the client IP address
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

  
	protected function transform($key, $value)
	{
		if (preg_match('/layers\.\d+\.text/', $key)) {
		return $value;
		}
		
		if (in_array($key, $this->except, true)) {
		return $value;
		}
		
		
		return is_string($value) ? trim($value) : $value;
	}
    
    public function CallApi($data,$url){ 
         
         $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$data,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: text/plain'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response);    
     }

     function SendNotification($title,$message){
        //$title = "Notification Title";
        //$message = "Notification Message";
        $icon = "https://houseofhiranandani-prioritycircle.in//H-logo.png";
        $url = "https://houseofhiranandani-prioritycircle.in/";
        
        $apiKey = "f40f80e560d7896362389892f66225f5";

        $curlUrl = "https://api.pushalert.co/rest/v1/send";

        //POST variables
        $post_vars = array(
            "icon" => $icon,
            "title" => $title,
            "message" => $message,
            "url" => $url
        );

        $headers = Array();
        $headers[] = "Authorization: api_key=".$apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_vars));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        $output = json_decode($result, true);

        return $output;
    }


     function SendEmail($data){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://offerapi.bluapps.in/api/api_hoh_mail_template.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $data,
        ));

        $result = curl_exec($curl);

        curl_close($curl);
        $output = json_decode($result, true);

        return $output;
    }

    function SendNotificationTOsubscriber($title,$message,$SUBSCRIBER_ID){

        $icon = "https://houseofhiranandani-prioritycircle.in//H-logo.png";
        $url = "https://houseofhiranandani-prioritycircle.in/";
        $subscriber = $SUBSCRIBER_ID;

        $apiKey = "f40f80e560d7896362389892f66225f5";

        $curlUrl = "https://api.pushalert.co/rest/v1/send";

        //POST variables
        $post_vars = array(
            "icon" => $icon,
            "title" => $title,
            "message" => $message,
            "url" => $url,
            "subscriber" => $subscriber
        );

        $headers = Array();
        $headers[] = "Authorization: api_key=".$apiKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curlUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_vars));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        $output = json_decode($result, true);
        return $output;
    }   

     
     function SendSMS( $mobile,$message,$templateID,$senderID)
    {	
    	$message = urlencode($message);
    	// http://vas.themultimedia.in/domestic/sendsms/bulksms.php?username=OSAPI&password=os123456&type=TEXT&sender=HIRANA&entityId=1101407690000029629&templateId=1507166799793980309&mobile=9820397227&message=Dear%7B%23var%23%7D%0AYour%20OTP%20for%20Hiranandani%20Exclusive%20website%20login%7B%23var%23%7DValid%20for%7B%23var%23%7DPlease%20do%20not%0Ashare%20this%20OTP.%0ARegards%2C%0AHiranandani%20Team.
    	$url="http://vas.themultimedia.in/domestic/sendsms/bulksms.php?username=OSAPI&password=os123456&type=TEXT&sender=$senderID&entityId=1101407690000029629&templateId=$templateID&mobile=$mobile&message=$message";
    	
    	// init the resource
    	$ch = curl_init();
    	curl_setopt_array($ch, array(
    		CURLOPT_URL => $url,
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_POST => false,
    		//,CURLOPT_FOLLOWLOCATION => true
    	));
    
    	//Ignore SSL certificate verification
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    
    	//get response
    	$output = curl_exec($ch);
    
    	//Print error if any
    	if(curl_errno($ch))
    	{
    		echo 'error:' . curl_error($ch);
    	}
    
    	curl_close($ch);
    
    	return  $output;
    
    }
    
    
    public function login(){ 
        //echo request('email');exit;
        try{
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 


                $user = Auth::user();
                $MapUserIP = DB::table('map_user_ip')->select('ip_address')->where('user_id','=',$user->id)->get();
               

                
                    
                $data=array('user_id'=>$user->id,"ip_address"=>request('ip_address'),"latitude"=>request('latitude'),"longitude"=>request('longitude'));
                DB::table('map_user_ip')->insert($data); 

                
                $channelPartner = DB::table('channel_partner')->select('is_active')->where('email_id','=',request('email'))->get();
                $random = Str::random(40);
                 
                User::where('email', request('email'))
                        ->update([
                            'remember_token' => $random
                            ]);
                $success['token'] =  $user->createToken($random)->accessToken;                
                
                
                $LocationData=array('user_id'=>$user->id,"latitude"=>request('latitude'),"longitude"=>request('longitude'));
                DB::table('map_user_location')->insert($LocationData);

               
                // if(count($MapUserIP) == 0){
                //     return response()->json(['success' => $success, 'msg' => 'You have Login Successfully', 'user' => $user, 'status' => $channelPartner[0]->is_active], $this-> successStatus);
                // }           
                // elseif(count($MapUserIP) > 0 && $MapUserIP[0]->ip_address == request('ip_address') ){
                //     return response()->json(['success' => $success, 'user' => $user, 'msg' => 'You have Login Successfully', 'status' => $channelPartner[0]->is_active], $this-> successStatus); 
                // }
                // else{
                //     return response()->json(['success' => false, 'msg' => 'Your not eligible for login'], $this-> successStatus);
                // }
                   
                return response()->json(['success' => $success, 'user' => $user, 'msg' => 'You have Login Successfully', 'status' => $channelPartner[0]->is_active], $this-> successStatus);
            } 
            else{ 
                return response()->json(['success' => false,'error'=>'Unauthorised', 'msg' => 'Wrong Username/Password'], 401); 
            } 
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }

    public function UpdateDeviceID(){ 
        //echo request('email');exit;
        try{
             $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){

                User::where('email', request('email'))
                        ->update([
                            'device_id' => request('sub_id')
                            ]);               
                return response()->json(['success' => true, 'user' => $user], $this-> successStatus);                   
                 
            } 
            else{ 
                return response()->json(['success' => false ,'error'=>'Unauthorised'], 401); 
            } 
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }

    
    public function loginCheck(){ 
        //echo request('email');exit;
        try{
           
            $User = DB::table('users')->select('id','email')->where('remember_token','=',request('token'))->where('email', '=', request('email'))->get();

            //dd($User);

            if(count($User) > 0){
                $ChannelPartner = DB::table('channel_partner')->select('is_active')->where('email_id','=',$User[0]->email)->get();
               
                return response()->json(['success' => 'true','User' => $User,'ChannelPartner' => $ChannelPartner], $this-> successStatus);
                 
            } 
            else{ 
                return response()->json(['success' => 'false'], 401); 
            } 
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }
    
    public function Register(){ 
        //echo request('email');exit;


        
        $User = DB::table('users')->select('id','email')->where('email', '=', request('email'))->get();

        if(count($User) > 0){
             return response()->json(['msg' => 'User already exists.'], $this-> successStatus);
        }
        else{
            if(request('email')  != ''){
                
                
                $data['cp_name'] = request('name');
                $data['email_id'] = request('email');
                $data['rerano'] = request('rerano');
                $data['mobile'] = request('mobile');
                $channel_partner = ChannelPartner::create($data);
                

                $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
                $API['name'] = request('name');
                $API['email'] =  request('email');
                $API['mobile_number'] =  request('mobile');
                $API['rera_reg_no'] =  request('rerano');
                $API['region_of_operation'] = 'Thane';
                $API['created_on'] = date('Y-m-d H:i:s');
                $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_register.php';
                
                $Jsondata = json_encode($API);
                $API = $this->CallApi($Jsondata,$url);
                

                DB::table('channel_partner')
                    ->where('email_id', request('email'))
                    ->update([
                    'cp_ref_no' => $API->ref_no
                    ]);
                User::create([
                'name' => request('name'),
                'email' => request('email'),
                'mobile' => request('mobile'),
                'password' => Hash::make(request('password')),
                ]);
                
                if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                    $random = Str::random(40);
                    $user = Auth::user(); 
                    User::where('email', request('email'))
                            ->update([
                                'remember_token' => $random
                                ]);
                    $success['token'] =  $user->createToken($random)->accessToken; 
                    return response()->json(['success' => $success, 'user' => $user,'status' => '0'], $this-> successStatus); 
                } 
                else{ 
                    return response()->json(['error'=>'Unauthorised'], 401); 
                }  
            }
        }
    }
    
    public function GetDashboardDetails()
    {
        $user = User::where('remember_token', request('token'))->get();
        if(isset($user[0]['name'])){
            $project = DB::table('map_project_cp')
                    ->select('map_project_cp.*')
                    ->join('channel_partner','map_project_cp.cp_id','=','channel_partner.id')
                    ->join('project','map_project_cp.project_id','=','project.id')
                    ->where('channel_partner.email_id','=',request('email'))
                    ->where('project.is_active','=','1')
                    ->get();
            $ChannelPartner = DB::table('channel_partner')->select('id','cp_id')->where('email_id','=',request('email'))->get();
           
           
            if($ChannelPartner[0]->cp_id > 0){

                ##  API for count of leads
                $API['cpid'] = $ChannelPartner[0]->cp_id;
                $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';     
                $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_leads.php';
                
                $Jsondata = json_encode($API);
                $Data = $this->CallApi($Jsondata,$url);  
                
                $LeadCount = 0 ;
                if($Data->status != 'error'){
                    $LeadCount = count($Data->data);
                }
                

                ##  API for count of Boookings
                $BookAPI['cpid'] = $ChannelPartner[0]->cp_id;
                $BookAPI['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';     
                $Bookurl = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_book_unit.php';
                
                $BookJsondata = json_encode($BookAPI);
                $BookData = $this->CallApi($BookJsondata,$Bookurl);   
                $BookCount = 0 ;
                if($BookData->status != 'error'){
                    $BookCount = count($BookCount->data);
                }
               
                
            }
            else{                
                $lead = DB::table('lead')
                        ->select('lead.*')
                        ->join('channel_partner','lead.cp_id','=','channel_partner.id')
                        ->where('channel_partner.email_id','=',request('email'))
                        ->get();

                $LeadCount = count($lead);
                $BookCount = 0;
               
            }
             return response()->json(['project' => count($project),'lead' => $LeadCount,'BookCount' => $BookCount], $this-> successStatus); 
        }
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
    
    
    public function GetProjects()
    {
        $user = User::where('remember_token', request('token'))->get();
        if(isset($user[0]['name'])){
            $project = DB::table('map_project_cp')
                    ->select('project.*','city.city_name')
                    ->join('project','map_project_cp.project_id','=','project.id')
                    ->join('city','project.city_id','=','city.id')
                    ->join('channel_partner','map_project_cp.cp_id','=','channel_partner.id')
                    ->where('channel_partner.email_id','=',request('email'))
                    ->where('project.is_active','=','1')
                    ->get();
            return response()->json(['project' => $project], $this-> successStatus); 
        }
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
    

    public function AddLead()
    {
        
        try{
              
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
                $API['mobile'] = request('mobile');


                $ChannelPartner = DB::table('channel_partner')->select('mobile','id')->where('email_id','=',request('username'))->get();


                // $Jsondata = json_encode($API);
                // $dupurl = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_lead_dup_check.php';
                // $DUPCHECK = $this->CallApi($Jsondata,$dupurl);
                $valid = true;
                    // if($DUPCHECK->status == 'error')
                    // { 
                    //     $valid = true;
                    // }
                    // elseif($DUPCHECK->status == 'success'){
                    //     $prev_date = date('Y-m-d', strtotime('-15 days'));                            
                    //     $prev_90_date = date('Y-m-d', strtotime('-90 days'));
                    //     $created_on = date('Y-m-d', strtotime($DUPCHECK->data[0]->created_on));
                    //     $last_activity_date = date('Y-m-d', strtotime($DUPCHECK->data[0]->last_activity_date));

                    //     ##  Checking for 90  days criteria
                    //     if(strtotime($prev_date) >= strtotime($created_on) &&  $DUPCHECK->data[0]->lead_status == 'WALK_IN' && strtotime($prev_90_date) < strtotime($last_activity_date)){
                    //         $valid = false;

                    //     }
                    //      ##  Checking for 15  days criteria
                    //     elseif(strtotime($prev_date) < strtotime($created_on)){
                    //         $valid = false;

                    //     }
                    // }

                    if($valid)
                    { 
                        
                        $Project = DB::table('project')
                                        ->select('integrations','lead_category','campaign_key')
                                        ->where('id','=',request('project_id'))
                                        ->get();
                        
                        $OTP = random_int(100000, 999999);
                        $name = request('name');
                        $uniqueid = time();
                        $email = request('email');
                        $mobile = request('mobile');
                        $location = request('location');
                        $project_id = request('project_id');
                        $integrations = $Project[0]->integrations;
                        $cp_id = $ChannelPartner[0]->id;
                        $url = 'https://net4hoh.sperto.co.in/_api/api_auth_post_lead_json.php';

                        $templateID = "1507167099767054151";
                        $message = "Dear Partner, Thank you for submission of leads. We will update you once it is accepted in the system.
HIRANANDANI";       
                            
                        $CPSMS = $this->SendSMS($ChannelPartner[0]->mobile,$message,$templateID,'HIRANA');

                        $title = 'Add Lead';
                        $message = "Dear Partner, Thank you for submission of leads. We will update you once it is accepted in the system.
HIRANANDANI";
                        $SendNotification = $this->SendNotification($title,$message);
                        // $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
                        // $API['lead_category'] = $Project[0]->lead_category;
                        // $API['customer_name'] = $name;
                        // $API['campaign_key'] = $Project[0]->campaign_key;
                        // $API['mobile_no1'] = $mobile;
                        // $API['email_id1'] = $email;                
                        // $API['guid'] = $uniqueid;
                        
                        
                        $data=array('name'=>$name,"email"=>$email,"mobile"=>$mobile,"project_id"=>$project_id,"location"=>$location,"cp_id"=>$cp_id,"OTP"=>$OTP,"integrations"=>$integrations,"uniqueid"=>$uniqueid,"is_verified"=>"Pending");
                        $lead = DB::table('lead')->insert($data);
                        if($lead){
                            
                            $templateID = "1507166799793980309";
                            $message = "Welcome to HOH Priority Circle. Your unique registration code is $OTP
                            Hiranandani Team.";
                            
                            $SMS = $this->SendSMS($mobile,$message,$templateID,'HIRANA');
                            
                        }

                        return response()->json(['success'=> true, 'msg'=>'OTP sent to mobile number', 'SMS_Report' => $SMS, 'CPSMS'=> $CPSMS, 'lead' => $lead,'uniqueid'=> $uniqueid], $this-> successStatus);    
                    }
                    else{

                        $templateID = "1507167099751534027";
                        $message = "Dear Partner, we are sorry to inform that the lead submitted by you is already in our records submitted by other source.
HIRANANDANI";
                            
                        $SMS = $this->SendSMS($ChannelPartner[0]->mobile,$message,$templateID,'HIRANA');

                        return response()->json(['success'=> false, 'msg'=>'Lead already exist.', 'SMS'=> $SMS], $this-> successStatus); 
                    }   
                       
                 
            }
            else{ 
                return response()->json(['success'=> false, 'msg'=>'User not logged in.', 'error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false, 'msg'=> $e->getMessage()]);
            
        }
    }
    
    
    public function GetProjectDetails()
    {
        $user = User::where('remember_token', request('token'))->get();
        if(isset($user[0]['name'])){
            $Project = DB::table('project')
                        ->select('project.*')
                        ->where('project.id','=',request('project_id'))
                        ->get();
            $ProjectCollateral = DB::table('project_collateral')
                            ->select('project_collateral.id','project_collateral.collateral_type','project_collateral.project_id',DB::raw('group_concat(CONCAT(map_collateral_image.path,"|",map_collateral_image.id)) as pathnames'),DB::raw('group_concat(CONCAT(map_collateral_image.msg_body,"|",map_collateral_image.id) SEPARATOR "()") as MsgBody'))
                            ->join('map_collateral_image','project_collateral.id','=','map_collateral_image.project_collateral_id')
                            ->where('project_collateral.project_id','=',request('project_id'))
                            ->groupBy('project_collateral.collateral_type')
                            ->get();

            $ChannelPartner = DB::table('channel_partner')
                                ->select('channel_partner.*')
                                ->where('email_id','=',$user[0]['email'])
                                ->get();
            //print_r($ProjectCollateral);exit;
            return response()->json(['Project' => $Project, 'ProjectCollateral' => $ProjectCollateral, 'ChannelPartner' => $ChannelPartner ], $this-> successStatus); 
        }
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
    
    public function ForgotPassword(){
        try{
            $user = User::where('email',request('email'))->get();   
            
            if(count($user) > 0){
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;
                //$data['url'] = $url;
                $data['email'] = request('email');
                $data['title'] = 'password reset.';
                $data['body'] = 'Please clickon below link to reset password.';

                $data['key'] = '816c8dca-4372-4667-b808-02da535d5178';
                $data['otp'] = '123456';
                $data['name'] = '';
                $data['email'] = request('email');//'webzaa.dev@gmail.com';//'webzaa.dev@gmail.com';// $user[0]['email']; 
                $data['subject'] = 'Forgot Password';
                //$data['body'] ='<h1>This is test mail</h1>'; 
                $msg_body = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>
</head>
<body style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family:  sans-serif; background-color: #811f49;">

<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#811f49"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: , sans-serif;">
        <tr>
            <td>
                <table style="background-color: #811f49; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                          <a title="logo" target="_blank">
                            <img width="200" src="https://houseofhiranandaniegattur.com/img/hohlogo.png" title="logo" alt="logo">
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:sans-serif;">You have
                                            requested to reset your password</h1>
                                        <span
                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                            We cannot simply send you your old password. A unique link to reset your
                                            password has been generated for you. To reset your password, click the
                                            following link and follow the instructions.
                                        </p>
                                        <a href="'.$url.'"                                       style="background:#811f49;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                            Password</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>Houseofhiranandani</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
   
</body>
</html> ';              
                $data['body'] = $msg_body;
                
                $sendmail = $this->SendEmail($data);
                
                // Mail::send('forgotpasswordmail',['data'=>$data],function($message) use ($data){
                //     $message->to($data['email'])->subject($data['title']);
                // });
                
                PasswordReset::updateorCreate(
                ['email' => request('email')],
                [
                	'email' => request('email'),
                	'token' => $token, 
                ]
                );
                
                return response()->json(['success'=> true,'msg'=> 'Mail sent successfully.']);
            }
            else{
                return response()->json(['success'=> false,'msg'=> 'User not found!']);
            }
            
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }
    
    public function VerifyOTP(){
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                $lead_otp = DB::table('lead')->select('OTP','name','email','mobile')->where('uniqueid','=',request('uniqueid'))->get();
                
                $Project = DB::table('project')->select('integrations','lead_category','campaign_key')->where('id','=',request('project_id'))->get();
                $ChannelPartner = DB::table('channel_partner')->select('mobile')->where('email_id','=',request('username'))->get();
                if(request('OTP') == $lead_otp[0]->OTP){

                    $templateID = "1507167099773923326";
                    $message = "Dear Partner, Thank you for submission of leads. This is to notify that your lead is accepted. Go ahead and schedule a site visit
HIRANANDANI";
                        
                    $SMS = $this->SendSMS($ChannelPartner[0]->mobile,$message,$templateID,'HIRANA');


                    $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
                    $API['lead_category'] = $Project[0]->lead_category;
                    $API['customer_name'] = $lead_otp[0]->name;
                    $API['campaign_key'] = $Project[0]->campaign_key;
                    $API['mobile_no1'] = $lead_otp[0]->mobile;
                    $API['email_id1'] = $lead_otp[0]->email;                
                    $API['guid'] = request('uniqueid');
                    $url = 'https://net4hoh.sperto.co.in/_api/api_auth_post_lead_json.php';
                    
                    $Jsondata = json_encode($API);
                    $API = $this->CallApi($Jsondata,$url);
                    
                    DB::table('lead')
                      ->where('uniqueid', request('uniqueid'))
                      ->update(['HOH_uniqueid' => $API->message,'is_verified' => 'Approved']);
                    return response()->json(['success'=> true,'msg'=> 'Lead added successfully.','API'=>$API]);    
                }
                else{
                    return response()->json(['success'=> false,'msg'=> 'Wrong OTP.']);
                }
                
            }
            else{
                return response()->json(['success'=> false,'msg'=> 'User not found!']);
            }
            
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
        
    }
    
     public function GetLeads()
    {
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
            
            $ChannelPartner = DB::table('channel_partner')->select('id','cp_id')->where('email_id','=',request('username'))->get();
            $start_date = '';
            $end_date = '';
           
            if($ChannelPartner[0]->cp_id > 0){

                    $API['cpid'] = $ChannelPartner[0]->cp_id;
                    $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';     
                    $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_leads.php';
                    
                    $Jsondata = json_encode($API);
                    $Data = $this->CallApi($Jsondata,$url);
                    $LeadData = $Data->data;
                
            }
            else{
                $query= DB::table('lead')
                    ->select('lead.*')
                    ->where('cp_id','=',$ChannelPartner[0]->id);
            
            
                //Status check of lead      
                if(request('status') != 'All'){                 
                    $query->where('is_verified','=',request('status'));
                }
                
                
                // lead specific data
                if(request('id') != ''){                    
                    $query->where('id','=',request('id'));
                }
                
                // lead date wise
                if(request('time_filter') == 'last_7_days'){
                    $end_date = date('Y-m-d');
                    $start_date = date('Y-m-d', strtotime('-7 days'));  
                                        
                    //$query->whereBetween('created_date', [$start_date, $end_date]);
                    $query->whereBetween(DB::raw('DATE(created_date)'), array($start_date, $end_date));
                }
                elseif(request('time_filter') == 'last_30_days'){
                    $end_date = date('Y-m-d');
                    $start_date = date('Y-m-d', strtotime('-30 days'));
                    
                    //$query->whereBetween('created_date', [$start_date, $end_date]);
                    $query->whereBetween(DB::raw('DATE(created_date)'), array($start_date, $end_date));
                }
                elseif(request('time_filter') == 'last_6_months'){
                    $end_date = date('Y-m-d');
                    $start_date = date('Y-m-d', strtotime("-6 months"));
                    
                    //$query->whereBetween('created_date', [$start_date, $end_date]);                   
                    $query->whereBetween(DB::raw('DATE(created_date)'), array($start_date, $end_date));
                }
                            
                    
                
                $LeadData= $query->get();
            }
            
              
                return response()->json(['LeadData' => $LeadData,'cp_id' => $ChannelPartner[0]->cp_id], $this-> successStatus); 
            }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }
    
     public function GetUserDetails(){ 
        //echo request('email');exit;
         try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                
                $ChannelPartner = DB::table('channel_partner')
                                ->select('channel_partner.*')
                                ->where('email_id','=',request('email'))
                                ->get();
                $Firm = DB::table('master')
                                ->select('master.*')
                                ->where('type','=','Firm')
                                ->get();
                $REGION = DB::table('master')
                                ->select('master.*')
                                ->where('type','=','REGION')
                                ->get();
                $MemberType = DB::table('master')
                                ->select('master.*')
                                ->where('type','=','Member Type')
                                ->get();
                
                return response()->json(['success' => true, 'user' => $ChannelPartner, 'Firm' => $Firm, 'REGION' => $REGION, 'MemberType' => $MemberType], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }
    
    public function UpdateUserDetails(Request $request){ 
     
       //print_r($request);exit;
       
         try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                $ChannelPartner = DB::table('channel_partner')->select('id')->where('email_id','=',request('email_id'))->get();
                
            if($request->file('profile_photo')) 
	        {
	            $profilename = $request->file('profile_photo');            
	            $profileext =  $profilename->getClientOriginalExtension();
	            $profilefilename = time().'.'.$profileext;
	            
	            $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/ProfilePhoto';
	            $profilename->move($location,$profilefilename);
	            $profilepath = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/ProfilePhoto/'.$profilefilename;

                DB::table('channel_partner')
                    ->where('email_id', request('email_id'))
                    ->update([
                    'profile_photo' => $profilepath
                    ]);
	           
	        }     

            if($request->file('rera_certificate_path')) 
            {
                $reraname = $request->file('rera_certificate_path');            
                $reraext =  $reraname->getClientOriginalExtension();
                $rerafilename = time().'.'.$reraext;
                
                $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/ReraCertificate';
                $reraname->move($location,$rerafilename);
                $rerapath = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/ReraCertificate/'.$rerafilename;
                DB::table('channel_partner')
                    ->where('email_id', request('email_id'))
                    ->update([
                    'rera_certificate_path' => $rerapath
                    ]);
               
            }    
            
            if($request->file('gst_certificate_path')) 
            {
                $gstname = $request->file('gst_certificate_path');            
                $gstext =  $gstname->getClientOriginalExtension();
                $gstfilename = time().'.'.$gstext;
                
                $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/GSTCertificate';
                $gstname->move($location,$gstfilename);
                $gstpath = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/GSTCertificate/'.$gstfilename;
                DB::table('channel_partner')
                    ->where('email_id', request('email_id'))
                    ->update([
                    'gst_certificate_path' => $gstpath 
                    ]);
               
            }    
            
            if($request->file('pan_card_path')) 
            {
                $panname = $request->file('pan_card_path');            
                $panext =  $panname->getClientOriginalExtension();
                $panfilename = time().'.'.$panext;
                
                $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/PANCard';
                $panname->move($location,$panfilename);
                $panpath = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/PANCard/'.$panfilename;
                    
                    DB::table('channel_partner')
                    ->where('email_id', request('email_id'))
                    ->update([
                    'pan_path' => $panpath  
                    ]);
               
            }


            
            if($request->file('company_logo')) 
            {
                $logoname = $request->file('company_logo');            
                $logoext =  $logoname->getClientOriginalExtension();
                $logofilename = time().'.'.$logoext;
                
                $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CompanyLogo';
                $logoname->move($location,$logofilename);
                $logopath = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CompanyLogo/'.$logofilename;
                    
                    DB::table('channel_partner')
                    ->where('email_id', request('email_id'))
                    ->update([
                    'company_logo' => $logopath  
                    ]);
               
            }

            $rera_expiry_date = '';
            if(request('rera_expiry_date') != ''){
                $rera_expiry_date = date('Y-m-d',strtotime(request('rera_expiry_date')));
            }


            $channel_partner = DB::table('channel_partner')
              ->where('email_id', request('email_id'))
              ->update([
                    'cp_name' => request('cp_name'),
                    'mobile' => request('mobile'),
                    'rerano' => request('rerano'),
                    'rera_expiry_date' => $rera_expiry_date,
                    'address' => request('address'),
                    'campany_name' => request('campany_name'),
                    'branch_name' => request('branch_name'),
                    'city' => request('city'),
                    'state' => request('state'),
                    'member_of' => request('member_of'),
                    'firm' => request('firm'),
                    'region' => request('region'),
                    'pan_no' => request('pan_no')
                    ]);
                    
            $update_user = User::where('email', request('email_id'))
                    ->update([
                        'name' => request('cp_name'),
                        'mobile' => request('mobile')
                        ]);
                  
                  
                
                return response()->json(['success' => true, 'channel_partner' => $channel_partner,'User' => $update_user,'profile' =>$request->file('profile_photo')], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
        
    }
    
    public function SendEmailer(){
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                $ProjectCollateral = DB::table('map_collateral_image')
                            ->select('map_collateral_image.path','project_collateral_id')
                            ->where('map_collateral_image.id','=',request('id'))
                            ->get();

                 $Project = DB::table('project')
                            ->select('project_name')
                            ->join('project_collateral','project_collateral.project_id','=','project.id')
                            ->where('project_collateral.id','=', $ProjectCollateral[0]->project_collateral_id)
                            ->get();
                            
                $ChannelPartner = DB::table('channel_partner')
                                ->select('mobile','rerano','company_logo')
                                ->where('email_id','=',$user[0]['email'])
                                ->get();
                                
                $msg_body = file_get_contents('https://cpapp.houseofhiranandani.com/Hohadmin/public/'.$ProjectCollateral[0]->path);

                $company_logo = '';
                if($ChannelPartner[0]->company_logo != ''){


                    $company_logo = 'https://cpapp.houseofhiranandani.com/Hohadmin/public/'.$ChannelPartner[0]->company_logo;

                }
                $variables = array("name"=>$user[0]['name'],"email_id"=>$user[0]['email'],"rerano"=>$ChannelPartner[0]->rerano,"mobile"=>$ChannelPartner[0]->mobile,"company_logo"=> $company_logo);
                //$msg_body = $ProjectCollateral[0]->msg_body;
                
                foreach($variables as $key => $value){
                    $msg_body = str_replace('{'.$key.'}', $value, $msg_body);
                }
                $data['key'] = '816c8dca-4372-4667-b808-02da535d5178';
                $data['otp'] = '123456';
                $data['name'] = $user[0]['name'];
                $data['email'] = $user[0]['email'];//'webzaa.dev@gmail.com';//'webzaa.dev@gmail.com';// $user[0]['email']; 
                $data['subject'] = 'Hiranandani Estate '.$Project[0]->project_name.' Emailer 2023';
                //$data['body'] ='<h1>This is test mail</h1>';                
                $data['body'] = $msg_body;
                
                $sendmail = $this->SendEmail($data);

                // Mail::send('SendEmailer',['data'=>$data],function($message) use ($data){
                //         $message->to($data['email'])->subject($data['title'])->setBody($data['body'], 'text/html');
                //     });
                    return response()->json(['success'=> true,'sendmail'=>$sendmail, 'msg'=> 'Mail sent successfully.']);
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

      public function GetBookings()
    {
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
            
            $ChannelPartner = DB::table('channel_partner')->select('id','cp_id')->where('email_id','=',request('username'))->get();
            $start_date = '';
            $end_date = '';
           
            if($ChannelPartner[0]->cp_id > 0){

                    $API['cpid'] = $ChannelPartner[0]->cp_id;
                    $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';     
                    $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_book_unit.php';
                    
                    $Jsondata = json_encode($API);
                    $Data = $this->CallApi($Jsondata,$url);
                    $BookingData = $Data->data;
                
            }
            else{
                $BookingData = array();
            }
            
              
                return response()->json(['BookingData' => $BookingData,'cp_id' => $ChannelPartner[0]->cp_id], $this-> successStatus); 
            }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }



    public function ResendOTP()
    {
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                if(request('id') > 0){
                    $Lead = DB::table('lead')
                        ->select('mobile','uniqueid')                   
                        ->where('id', request('id'))
                        ->get();


                        $OTP = random_int(100000, 999999);
                        DB::table('lead')
                          ->where('id', request('id'))
                          ->update(['OTP' => $OTP]);
                        $templateID = "1507166799793980309";
                        $message = "Welcome to HOH Priority Circle. Your unique registration code is $OTP
                        Hiranandani Team.";
                        
                        $SMS = $this->SendSMS($Lead[0]->mobile,$message,$templateID,'HIRANA');

                        return response()->json(['msg' => 'OTP sent to your mobile number.','uniqueid'=>$Lead[0]->uniqueid], $this-> successStatus); 
                    }
                    else{
                        return response()->json(['msg' => "No lead Found"], $this-> successStatus); 
                    }
                }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
            }
        
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

    public function AddCDCProfile(Request $request)
    {
        
        try{
            
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
                $ChannelPartner = DB::table('channel_partner')
                                ->select('id')
                                ->where('email_id','=',request('username'))
                                ->get();
                $name = request('name');
                $profile_name = request('profile_name');
                $mobile = request('mobile');
                $email = request('email');
                $rera_no = request('rera_no');
                $profile_id = request('profile_id');
                $logo_path = '';
                if($profile_id > 0){

                    if($request->file('logo')) 
                    {
                        $logoname = $request->file('logo');            
                        $logoext =  $logoname->getClientOriginalExtension();
                        $logofilename = time().'.'.$logoext;
                        
                        $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CDCProfile';
                        $logoname->move($location,$logofilename);
                        $logo_path = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CDCProfile/'.$logofilename; 

                        $CDCProfile = DB::table('cdc_profile')
                                          ->where('id', $profile_id)
                                          ->update([
                                                    'logo_path' => $logo_path
                                                ]);                
                       
                    }

                    $CDCProfile = DB::table('cdc_profile')
                                          ->where('id', $profile_id)
                                          ->update([
                                                    'name' => $name,
                                                    'profile_name' => $profile_name,
                                                    'mobile' => $mobile,
                                                    'email' => $email,
                                                    'rera_no' => $rera_no
                                                ]); 
                }
                else{
                    if($request->file('logo')) 
                    {
                        $logoname = $request->file('logo');            
                        $logoext =  $logoname->getClientOriginalExtension();
                        $logofilename = time().'.'.$logoext;
                        
                        $location = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CDCProfile';
                        $logoname->move($location,$logofilename);
                        $logo_path = 'ChannelPartnerImages/'.$ChannelPartner[0]->id.'/CDCProfile/'.$logofilename;                
                       
                    }
                    
                    $data=array('name'=>$name,"profile_name"=>$profile_name,"mobile"=>$mobile,"email"=>$email,"rera_no"=>$rera_no,"user_id"=>$user[0]['id'],"logo_path"=>$logo_path);
                    $CDCProfile = DB::table('cdc_profile')->insert($data);
                }
                
                return response()->json(['success'=> true,'CDCProfile' => $CDCProfile], $this->successStatus); 
                
                 
            }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

    public function GetCDCProfile()
    {
        
        try{
            $user = User::where('remember_token', request('token'))->get();
            if(isset($user[0]['name'])){
 
            
                $query= DB::table('cdc_profile')
                    ->select('cdc_profile.*')
                    ->where('user_id','=',$user[0]['id']);
           
                if(request('profile_id') > 0){                 
                    $query->where('id','=',request('profile_id'));
                }

                $ProfileCDCData= $query->get();
           
            
              
                return response()->json(['success'=> true,'ProfileCDCData' => $ProfileCDCData], $this-> successStatus); 
            }
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

    
    public function GetUserLoginHistory()
    {
        
        try{

            $IP_data = DB::table('map_user_ip')->select('map_user_ip.*')->where('user_id','=',request('user_id'))->get();
            $Location_data = DB::table('map_user_location')->select('map_user_location.*')->where('user_id','=',request('user_id'))->get();
              
            return response()->json(['success'=> true,'IP_data' => $IP_data,'Location_data' => $Location_data], $this-> successStatus); 
            
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

    public function AddCPToApp()
    {
        
        try{
            $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
            $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_list.php';
            
            $Jsondata = json_encode($API);
            $API = $this->CallApi($Jsondata,$url);

            if($API->status == 'success'){
                $data = $API->data;
                foreach ($data as $key=>$cp) {

                    $cpdata['cp_name'] = $cp->cp_name;
                    $cpdata['email_id'] = $cp->email_id;
                    $cpdata['rerano'] = $cp->rera_registration_no;
                    $cpdata['mobile'] = $cp->mobile; 
                    $cpdata['pan_no'] = $cp->pan_no;   
                    $cpdata['cp_ref_no'] = $cp->cp_ref_no;   
                    $cpdata['address'] = $cp->address;   
                    $cpdata['city'] = $cp->city;   
                    $cpdata['state'] = $cp->state; 
                    $cpdata['gstno'] = $cp->gst_no;   
                    $cpdata['cp_id'] = $cp->cp_id;     
                    $cpdata['firm'] = $cp->firm_type;  
                    $cpdata['region'] = $cp->region_of_operation; 
                    $cpdata['member_of'] = $cp->member_of;   
                    $mob = substr($cp->mobile, -4);
                    $pan = substr(strtoupper($cp->pan_no), 0, 4);
                    $password = $pan.''.$mob;   
                     $data[$key]->password = $password;
                   
                    $ChannelPartner = DB::table('channel_partner')->select('id')->where('email_id','=',$cp->email_id)->get(); 
                   //echo $cp->email_id;
                    if(count($ChannelPartner) == 0){
                        $channel_partner = ChannelPartner::create($cpdata);
                    }
                    
                    $user = DB::table('users')->select('id')->where('email','=',$cp->email_id)->get(); 

                    if(count($user) == 0){
                        $user = User::create([
                            'name' => $cp->cp_name,
                            'email' => $cp->email_id,
                            'mobile' => $cp->mobile,
                            'password' => Hash::make($cp->mobile),
                        ]);
                    }

                    $data[$key]->channel_partner = $channel_partner;
                    $data[$key]->user = $user;
                }
            }

            return response()->json(['success'=> true,'channel_partner' => $data], $this-> successStatus); 
           
        }
        catch(\Exception $e){
            return response()->json(['success'=> false,'msg'=> $e->getMessage()]);
            
        }
    }

   
    
    
}



?>
