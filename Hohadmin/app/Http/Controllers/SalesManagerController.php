<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SalesManager;
use App\Models\User;
use App\Models\project;
use App\Models\MapSMProjects;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;

class SalesManagerController extends Controller
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
    public function index(Request $request)
    {
        
        $search = $request['search'] ?? ''; 
          
        
        if($search != ''){            
            $SalesManager = SalesManager::where('sm_name','LIKE','%'.$search.'%')->orWhere('email_id','LIKE','%'.$search.'%')->orWhere('mobile','LIKE','%'.$search.'%')->orWhere('vendor_id','LIKE','%'.$search.'%')->orWhere('company_name','LIKE','%'.$search.'%')->orWhere('gst_no','LIKE','%'.$search.'%')->orWhere('acc_no','LIKE','%'.$search.'%')->paginate(100);
        }        
        else{
            $SalesManager = SalesManager::orderBy('id','desc')->paginate(100);
        }
        
        return view('SalesManager.index', compact('SalesManager','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = project::all();
        return view('SalesManager.create', [
            'all_projects' => $data
            
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
        //echo '<pre>';print_r($data);exit;
        $request->validate([
            'sm_name' => 'required'
        ]);

        
        $sale_manager = SalesManager::create($request->post());
        $last_insert_id = $sale_manager->id;
        //echo $last_insert_id;exit;
        $i = 0;
        foreach($data['projects'] as $value){
            $insert[$i]['sm_id'] =  $last_insert_id;
            $insert[$i]['project_id'] = $value;
            
            $i++;
        }
        MapSMProjects::insert($insert);

        
        User::create([
            'name' => $data['sm_name'],
            'email' => $data['email_id'],
            'role_id' => '3',
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('SalesManager.index')->with('success','Sales Manager has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesManager  $salesManager
     * @return \Illuminate\Http\Response
     */
    public function show(SalesManager $SalesManager)
    {
        return view('SalesManager.show',compact('SalesManager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesManager  $salesManager
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesManager $SalesManager)
    {
        
        
        $MapProjectSM = DB::table('map_project_sm')
        ->select('map_project_sm.id','map_project_sm.project_id','map_project_sm.sm_id')
        ->where('map_project_sm.sm_id', '=', $SalesManager->id)
        ->groupBy('sm_id','project_id')
        ->get();
        $data = project::all();
        return view('SalesManager.edit', [
            'all_projects' => $data,
            'MapProjectSM' => $MapProjectSM,
            'SalesManager' => $SalesManager
            
        ]);
        return view('SalesManager.edit',compact('SalesManager'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesManager  $salesManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesManager $SalesManager)
    {
        
        $data =  $request->post();
        //echo'<pre>';print_r($data);exit;
        $request->validate([
            'sm_name' => 'required'
        ]);
        
        DB::table('map_project_sm')->where('sm_id', $SalesManager->id)->delete();
        if(isset($data['projects'])){
            $i = 0;
            foreach($data['projects'] as $value){
                $insert[$i]['sm_id'] =  $SalesManager->id;
                $insert[$i]['project_id'] = $value;
                
                $i++;
            }
            MapSMProjects::insert($insert);
        }
        
        $SalesManager->fill($data)->save();

        return redirect()->route('SalesManager.index')->with('success','Sales Manager Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesManager  $salesManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesManager $SalesManager)
    {
        $SalesManager->delete();
        return redirect()->route('SalesManager.index')->with('success','Sales Manager has been deleted successfully');
    }


    
    public function StatusUpdate($id)
    {
       $sales_manager = DB::table('sales_manager')
                    ->select('is_active')
                    ->where('id','=',$id)
                    ->first();

        //print_r($project);exit;
        if($sales_manager->is_active == '1'){
            $is_active = '0';
        }
        else{
            $is_active = '1';
        }

        $values = array('is_active'=> $is_active);

        DB::table('sales_manager')->where('id',$id)->update($values);

        return redirect()->route('SalesManager.index')->with('success','Sales Manager status has been updated successfully.');
    }
}
