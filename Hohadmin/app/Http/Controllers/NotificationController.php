<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use App\Models\Role;
use App\Models\PasswordReset;
use App\Models\UsersPermissions;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        
        
        $Notification = DB::table('notification')
        ->select('notification.id','users.name','title','msg_body','created_date')
        ->leftJoin('users', 'notification.user_id', '=', 'users.id')              
        ->paginate(100);
        
       
        return view('Notification.index', ['AllNotifications' => $Notification]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $User = DB::table('users')
        ->select('users.*')     
        ->where('device_id','!=','')        
        ->get();

        // $User = User::all();
        return view('Notification.create', [
            'User' => $User          
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->post();
        

       
        foreach ($data['id_users'] as $id_user) {

            $DeviceID = DB::table('users')->select('device_id')->where('id','=',$id_user)->get();

            
             $SendNotificationTOsubscriber = $this->SendNotificationTOsubscriber($data['title'],$data['msg_body'],$DeviceID[0]->device_id);
             
             //dd($SendNotificationTOsubscriber);
             $NotificationData = DB::table('notification')->insert([
                'user_id' => $id_user,
                'title' => $data['title'],
                'msg_body' => $data['msg_body']
            ]);
           
        }
        

        return redirect()->route('Notification.index')->with('success','Notification has been Sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $Notification)
    {
       
        $UserRole = DB::table('users_roles')
        ->select('users_roles.role_id',DB::raw('ifnull(roles.name,"") as role_name'))    
        ->leftJoin('roles', 'roles.id', '=', 'users_roles.role_id') 
        ->where('user_id','=',$User->id)            
        ->get();
        $Role = Role::all();
        $UserAll = User::all();
        
        //return view('User.edit',compact('User'));
        return view('User.edit', ['User' => $User,'UserAll' => $UserAll,'Role' => $Role,'UserRole'=>$UserRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $Notification)
    {
          
        //echo'<pre>';print_r($city);exit;
        $data = $request->post();
        $request->validate([
            'user_name' => 'required',
            'email' => 'required'
        ]);
       

        $User->fill($request->post())->save();

        if(isset($data['roles'])){
            $UserRole = DB::table('users_roles')
            ->select('users_roles.role_id')   
            ->where('user_id', $User->id)
            ->get();

            if (count($UserRole) > 0) {
                $affected = DB::table('users_roles')
                ->where('user_id', $User->id)
                ->update(['role_id' => $data['roles']]);
            } else {
                DB::table('users_roles')->insert([
                    'user_id' => $User->id,
                    'role_id' => $data['roles']
                ]);
            }
        }

        $GetPermissions = DB::table('roles_permissions')
                        ->select('roles_permissions.permission_id')   
                        ->where('role_id', $data['roles'])
                        ->get();
        // Delete all permissions   
        UsersPermissions::where('user_id', $User->id)->delete();


         // Insert all permissions  
        for ($i = 0; $i < count( $GetPermissions); $i++) {
            $insert[$i]['user_id'] =  $User->id;
            $insert[$i]['permission_id'] =  $GetPermissions[$i]->permission_id;
        }

        UsersPermissions::insert($insert);
        //echo'<pre>';print_r($GetPermissions);exit;

        return redirect()->route('User.index')->with('success','User Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $Notification)
    {
        $User->delete();
        return redirect()->route('User.index')->with('success','User has been deleted successfully');
    }
    
    public function ResetPasswordLoad(Request $request){
    	$resetdata = PasswordReset::where('token',$request->token)->get();
    	if(isset($request->token) && count($resetdata) > 0){
    		$user = User::where('email',$resetdata[0]['email'])->get();
    		return view('ResetPassword',compact('user'));
    	}
    	else{
    		return view('home');
    	}
    }
    
    
    public function ResetPassword(Request $request){
        
        $request->validate([
            'password' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:password',    
        ]);
        
        $user= User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        
        PasswordReset::where('email',$user->email)->delete();
        
        return "<h1>Password reset successfully.</h1>";
        
    }

    ## Send Notification
     function SendNotificationTOsubscriber($title,$message,$SUBSCRIBER_ID){

        $icon = "https://cpapp.houseofhiranandani.com/H-logo.png";
        $url = "https://cpapp.houseofhiranandani.com/";
        $subscriber = $SUBSCRIBER_ID;

        $apiKey = "f1d7e62fe3fb10a9c4c68beeb1237d6a";

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
}
