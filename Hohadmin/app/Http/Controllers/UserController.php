<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\PasswordReset;
use App\Models\UsersPermissions;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        
        
        $User = DB::table('users')
        ->select('users.id','users.name','email','mobile','email',DB::raw('ifnull(roles.name,"") as role_name'))
        ->leftJoin('users_roles', 'users_roles.user_id', '=', 'users.id')     
        ->leftJoin('roles', 'roles.id', '=', 'users_roles.role_id')              
        ->paginate(100);
        
       
        return view('User.index', ['all_Users' => $User]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Role = Role::all();
        $User = User::all();
        return view('User.create', [
            'Role' => $Role, 
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
        //echo'<pre>';print_r($data);exit;
        // $request->validate([
            
        //     'user_name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        $UserData = DB::table('users')->insert([
            'name' => $data['user_name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'reporting_to' => $data['reporting_to'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make($data['password']),
        ]);
        $lastInsertId = DB::getPdo()->lastInsertId();
        

        if($lastInsertId > 0 && isset($data['roles']) && $data['roles'] != ''){

            DB::table('users_roles')->insert([
                'user_id' => $lastInsertId,
                'role_id' => $data['roles']
            ]);

            $lastInsertRoleId = DB::getPdo()->lastInsertId();
        

            $GetPermissions = DB::table('roles_permissions')
            ->select('roles_permissions.permission_id')   
            ->where('role_id', $data['roles'])
            ->get();

            // Delete all permissions   
            UsersPermissions::where('user_id', $lastInsertId)->delete();


            // Insert all permissions  
            for ($i = 0; $i < count( $GetPermissions); $i++) {
            $insert[$i]['user_id'] =  $lastInsertId;
            $insert[$i]['permission_id'] =  $GetPermissions[$i]->permission_id;
            }

            UsersPermissions::insert($insert);
        }
        
        

        return redirect()->route('User.index')->with('success','User has been created successfully.');
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
    public function edit(User $User)
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
    public function update(Request $request, User $User)
    {
          
        //echo'<pre>';print_r($city);exit;
        $data = $request->post();
        //dd($data);
        //echo'<pre>';print_r($data);exit;
        
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
    public function destroy(User $User)
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
        
        return "<h1>Password reset successfully.</h1><br><a href='https://cpapp.houseofhiranandani.com'>Click here to login with new password</a>";
        
    }
}
