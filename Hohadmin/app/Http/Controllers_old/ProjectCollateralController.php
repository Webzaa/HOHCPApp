<?php

namespace App\Http\Controllers;

use App\Models\ProjectCollateral;
use App\Models\project;
use App\Models\MapCollateralImage;
use App\Models\CollateralTypes;

use Illuminate\Http\Request;
use DB;
use File;
use PhpParser\Node\Stmt\Foreach_;

class ProjectCollateralController extends Controller
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
        $ProjectCollateral = DB::table('project_collateral')
                    ->select('project_collateral.id','project_collateral.project_id','project_collateral.collateral_type','project.project_name','collateral_types.name as collateral_name',DB::raw('group_concat(map_collateral_image.path) as pathnames'))
                    ->leftJoin('project','project_collateral.project_id','=','project.id')
                    ->leftJoin('collateral_types','project_collateral.collateral_type','=','collateral_types.id')
                    ->leftJoin('map_collateral_image','map_collateral_image.project_collateral_id','=','project_collateral.id')
                    ->groupBy('project_id','collateral_type')
                    ->limit(5)->get();

        $data['ProjectCollateral'] = $ProjectCollateral;

        //echo'<pre>';print_r(compact($data));exit;
        //$project = project::orderBy('id','desc')->paginate(5);
        return view('ProjectCollateral.index', $data);
        // $ProjectCollateral = ProjectCollateral::orderBy('id','desc')->paginate(5);
        // return view('ProjectCollateral.index', compact('ProjectCollateral'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $data = project::all();
        $CollateralTypes = CollateralTypes::all();
        return view('ProjectCollateral.create', [
            'all_projects' => $data,
            'CollateralTypes' => $CollateralTypes
            
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
      
        //echo '<pre>';print_r($request->post());exit;
        $request->validate([
            
            'project_id' => 'required',
            'collateral_type' => 'required',
            'files.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        
        $project_collateral = DB::table('project_collateral')
                    ->select('project_collateral.id')
                    ->where('project_id', '=',$data['project_id'])
                    ->where('collateral_type', '=', $data['collateral_type'])
                    ->get();
        

        if(isset($project_collateral[0]->id)){
            $last_insert_id = $project_collateral[0]->id;
        }
        else{
            //$last_insert_id = ProjectCollateral::insert($request->post())->insertGetId(); 
            $last_insert_id = DB::table('project_collateral')-> insertGetId(array(
                'project_id' =>  $data['project_id'],
                'collateral_type' => $data['collateral_type'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ));
        }
        
        //echo $last_insert_id;exit;
        if($request->hasfile('files0'))
        {
            for ($i = 0; $i < $data['TotalFiles']; $i++) {
                $filename = $request->file('files'.$i);
                $fileext =  $filename->getClientOriginalExtension();
                //$newfilename = time().'_'.$i.'.jpg';
                $newfilename = time().'_'.$i.'.'.$fileext;
                $location = 'projects/'.$data['project_name'].'/ProjectCollateral/'.$data['collateral_name'];
                $filename->move($location,$newfilename);
                $path = $location.'/'.$newfilename;
                $insert[$i]['project_collateral_id'] =  $last_insert_id;
                $insert[$i]['path'] = $path;
                $insert[$i]['created_at'] = date('Y-m-d H:i:s');
                $insert[$i]['updated_at'] = date('Y-m-d H:i:s');
                
            }

            MapCollateralImage::insert($insert);
        }
        session(['success'=>'Project has been updated successfully.']);
        
        return response()->json(['status'=>'Project has been created successfully.',"redirect_url"=>url('project')]);
  
        //return redirect()->route('project.index')->with('success','project Collateral has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectCollateral  $ProjectCollateral
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectCollateral $ProjectCollateral)
    {
        return view('ProjectCollateral.show',compact('ProjectCollateral'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectCollateral  $ProjectCollateral
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectCollateral $ProjectCollateral)
    {
        $data = project::all();
        $CollateralTypes = CollateralTypes::all();
        $ProjectCollateralTable = DB::table('project_collateral')
        ->select('project_collateral.id','project_collateral.project_id','project_collateral.collateral_type','project.project_name','collateral_types.name as collateral_name',DB::raw('group_concat(CONCAT(map_collateral_image.path,"|",map_collateral_image.id)) as pathnames'))
        ->leftJoin('project','project_collateral.project_id','=','project.id')
        ->leftJoin('collateral_types','project_collateral.collateral_type','=','collateral_types.id')
        ->leftJoin('map_collateral_image','map_collateral_image.project_collateral_id','=','project_collateral.id')
        ->where('project_collateral.id', '=', $ProjectCollateral->id)
        ->groupBy('project_id','collateral_type')
        ->get();

        //$ProjectCollateral;
        return view('ProjectCollateral.edit', [
            'all_projects' => $data,
            'CollateralTypes' => $CollateralTypes,
            'ProjectCollateral' => $ProjectCollateralTable
            
        ]);
        //return view('ProjectCollateral.edit',compact('ProjectCollateral'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectCollateral  $ProjectCollateral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectCollateral $ProjectCollateral)
    {
        $data = $request->post();
       
       
        $request->validate([
            'files' => 'required',
            'project_id' => 'required',
            'collateral_type' => 'required',
            'files.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);
        //echo'<pre>';print_r($city);exit;
    
        
        $ProjectCollateral->fill($data)->save();
        $last_insert_id = ProjectCollateral::select('id')
                        ->where('project_id', '=', 'Root')
                        ->where('collateral_type', '=', "2")
                        ->get();
        //print_r($last_insert_id);exit;
        if($request->hasfile('files0'))
        {
            for ($i = 0; $i < $data['TotalFiles']; $i++) {
                $filename = $request->file('files'.$i);
                $newfilename = time().'_'.$i.'.jpg';
                $location = 'projects/'.$data['project_name'].'/ProjectCollateral/'.$data['collateral_name'];
                $filename->move($location,$newfilename);
                $path = $location.'/'.$newfilename;
                $insert[$i]['project_collateral_id'] =  $last_insert_id;
                $insert[$i]['path'] = $path;
                $insert[$i]['created_at'] = date('Y-m-d H:i:s');
                $insert[$i]['updated_at'] = date('Y-m-d H:i:s');
                
            }

            MapCollateralImage::insert($insert);
        }

        return redirect()->route('ProjectCollateral.index')->with('success','Project Collateral Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectCollateral  $ProjectCollateral
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ProjectCollateral $ProjectCollateral)
    // {
    //     $ProjectCollateral->delete();
    //     return redirect()->route('ProjectCollateral.index')->with('success','Project Collateral has been deleted successfully');
    // }

    public function destroy($id)
    {
        
       
        $ProjectCollateralFiles = DB::table('map_collateral_image')
                    ->select('path','id')
                    ->where('project_collateral_id',$id)
                    ->get();

        //File::deleteDirectory(public_path('path/to/folder'));
       
        foreach ($ProjectCollateralFiles as $key => $value) {
            
            if(File::exists(public_path($value->path))){
                File::delete(public_path($value->path));
               
            }
            DB::table('map_collateral_image')->where('id', '=', $value->id)->delete();
          
            # code...
        }

        DB::table('project_collateral')->where('id', '=', $id)->delete();
        
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
