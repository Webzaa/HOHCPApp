<?php

namespace App\Http\Controllers;

use App\Models\RolesPermission;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use DB;
use Log;


class RolesPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**


     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $Role = Role::all();

        return view('RolesPermission.index',['all_Roles' => $Role]);
        
    }

    public function GetPermissions($id)
    {

        $Permission = DB::table('permissions')
        ->select('permissions.id','name','slug',DB::raw('ifnull(rp.permission_id,"") as permission_id'))
        ->leftJoin('roles_permissions AS rp', function($join) use ($id){
            $join->on('rp.permission_id', '=', 'permissions.id')
                ->where('rp.role_id', '=', $id);
        })
        ->get(); 

        return response()->json([
            'all_Permissions' => $Permission
        ]);
        
    }

    
    public function StoreRolePermission(Request $request)
    {
       
        $input = $request->all();

        // checking for new role
        if(!is_numeric($input['role_id'])){
            //if new role insert
            $slug = str_replace(' ', '-', strtolower($input['role_id']));
            
            $last_inserted_id = DB::table('roles')-> insertGetId(array(
                'name' => $input['role_id'],
                'slug' => $slug,
            ));
            
            $role_id = $last_inserted_id;
        }
        else{
            $role_id =  $input['role_id'];
        }   
        // Delete all permissions   
        RolesPermission::where('role_id', $role_id)->delete();


         // Insert all permissions  
        for ($i = 0; $i < count($input['permissions']); $i++) {
            $insert[$i]['role_id'] =  $role_id;
            $insert[$i]['permission_id'] = $input['permissions'][$i];
        }

        RolesPermission::insert($insert);
        
        
        return response()->json(['success'=>'Roles Added Successfully.']);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolesPermission  $rolesPermission
     * @return \Illuminate\Http\Response
     */
    public function show(RolesPermission $rolesPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolesPermission  $rolesPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(RolesPermission $rolesPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolesPermission  $rolesPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolesPermission $rolesPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolesPermission  $rolesPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolesPermission $rolesPermission)
    {
        //
    }
}
