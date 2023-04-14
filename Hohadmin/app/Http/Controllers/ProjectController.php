<?php

namespace App\Http\Controllers;
use App\Models\project;
use App\Models\MapCollateralImage;
use App\Models\ProjectCollateral;
use App\Models\city;
use App\Models\User;
use App\Models\Amenities;
use App\Models\Master;
use App\Models\CollateralTypes;
use App\Models\ProjectType;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use ZipArchive;
use Auth;

class ProjectController extends Controller
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

    public function index(Request $request)
    {
        
        $id = Auth::user()->id;
        $User = User::find($id);
        //dd($User->Permission);
        //echo Auth::user();
        // exit;
        $search = $request['search'] ?? ''; 
          
        
        if($search != ''){
            $project = DB::table('project')
                    ->select('project.*','city.city_name')
                    ->join('city','project.city_id','=','city.id')
                    ->where('project_name','LIKE','%'.$search.'%')->orWhere('configuration','LIKE','%'.$search.'%')->orWhere('price','LIKE','%'.$search.'%')->orWhere('city.city_name','LIKE','%'.$search.'%')
                    ->paginate(100);
        }
        else{
            $project = DB::table('project')
            ->select('project.*','city.city_name')
            ->join('city','project.city_id','=','city.id')
            ->paginate(100);
        }
            

        $data['project'] = $project;
        $data['search'] = $search;  

        //echo'<pre>';print_r(compact($data));exit;
        //$project = project::orderBy('id','desc')->paginate(5);
        return view('project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = city::all();
        //$ProjectType = ProjectType::all();
        $ProjectType = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Project Type')
                     ->get();
        $Integration = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Integration')
                     ->get();
                     
        $lead_category = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Lead Category')
                     ->get();
        //$Amenities = Amenities::all();
        $Amenities = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Amenities')
                     ->get();
        //echo '<pre>';print_r($Amenities);exit; 
        
        //$CollateralTypes = CollateralTypes::all();
        $CollateralTypes = DB::table('master')
                        ->select('sub_type')
                        ->where('type','=','Collater Type')
                        ->get();            
        
        $Configurations = DB::table('master')
                        ->select('sub_type')
                        ->where('type','=','Configuration')
                        ->get();            
        
        return view('project.create', [
            'all_cities' => $city,
            'all_project_types' => $ProjectType,
            'all_amenities' => $Amenities,
            'all_collaterals' => $CollateralTypes,
            'all_configurations' => $Configurations,
            'all_integration' => $Integration ,
            'all_lead_category' => $lead_category ,
            
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
        
        // $collateral = json_decode(stripslashes($data['collateral']));

        // echo'<pre>';print_r($collateral);exit;
        if(!isset($data['possession_date']) && $data['possession_date'] == ''){
            $data['possession_date'] = date('Y-m-d');
        }
        if(isset($data['amenities_id']) && $data['amenities_id'] != ''){
            $amenities = implode(',',$data['amenities_id']);
            $data['amenities_id'] = $amenities;
        }
        else{
            $data['amenities_id'] = '';
        }
        if(isset($data['configuration']) && $data['configuration'] != ''){
            $amenities = implode(',',$data['configuration']);
            $data['configuration'] = $amenities;
        }
        else{
            $data['configuration'] = '';
        }
        $request->validate([
            'project_name' => 'required',
            'configuration' => 'required',
            'price' => 'required',
            'files.*' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        if($request->hasfile('rera_certificate'))
        {
            $reraname = $request->file('rera_certificate');            
            $reraext =  $reraname->getClientOriginalExtension();
            $rerafilename = time().'.'.$reraext;
            
            $location = 'projects/'.str_replace(' ','_',$data['project_name']).'/ReraCertificate';
            $reraname->move($location,$rerafilename);
            $rerapath = 'projects/'.str_replace(' ','_',$data['project_name']).'/ReraCertificate/'.$rerafilename;
            $data['rera_certificate_path'] = $rerapath;
        }
        if($request->hasfile('hero_image'))
        {
            $heroname = $request->file('hero_image');
            $herofilename = time().'.jpg';
            $location = 'projects/'.str_replace(' ','_',$data['project_name']).'/HeroImage';
            $heroname->move($location,$herofilename);
            $heropath = 'projects/'.str_replace(' ','_',$data['project_name']).'/HeroImage/'.$herofilename;
            $data['hero_image_path'] = $heropath;
        }
        
       
        
        
        $project_insert = project::create($data);

        $project_name = $project_insert->project_name;
        $last_inserted_id = $project_insert->id;
       
        $return_data['last_inserted_id'] = $last_inserted_id;
        $return_data['project_name'] = $project_name;

        
        if($data['collateral_array'] > 0)
            return $return_data;
        else{
            return redirect()->route('project.index')->with('success','Project has been created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(project $project)
    {
        return view('project.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(project $project)
    {
        $city = city::all();
        
        $ProjectType = DB::table('master')
        ->select('sub_type')
        ->where('type','=','Project Type')
        ->get();
        
         $Integration = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Integration')
                     ->get();
                     
        $lead_category = DB::table('master')
                     ->select('sub_type')
                     ->where('type','=','Lead Category')
                     ->get();
                     
        //$Amenities = Amenities::all();
        $Amenities = DB::table('master')
                ->select('sub_type')
                ->where('type','=','Amenities')
                ->get();
        //echo '<pre>';print_r($Amenities);exit; 

        //$CollateralTypes = CollateralTypes::all();
        $CollateralTypes = DB::table('master')
                ->select('sub_type')
                ->where('type','=','Collater Type')
                ->get();            

        $Configurations = DB::table('master')
                ->select('sub_type')
                ->where('type','=','Configuration')
                ->get();
        $ProjectCollateral = DB::table('project_collateral')
                            ->select('project_collateral.id','project_collateral.collateral_type','project_collateral.project_id',DB::raw('group_concat(CONCAT(map_collateral_image.path,"|",map_collateral_image.id)) as pathnames'))
                            ->join('map_collateral_image','project_collateral.id','=','map_collateral_image.project_collateral_id')
                            ->where('project_collateral.project_id','=',$project->id)
                            ->groupBy('project_collateral.collateral_type')
                            ->get();
                            
        return view('project.edit', [
            'all_cities' => $city,
            'all_project_types' => $ProjectType,
            'all_amenities' => $Amenities,
            'all_collaterals' => $CollateralTypes,
            'project_collateral' => $ProjectCollateral,
            'all_configurations' => $Configurations,
            'project'=> $project,
            'all_integration' => $Integration ,
            'all_lead_category' => $lead_category ,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, project $project)
    {
        $data = $request->post();
        
        if(!isset($data['possession_date']) && $data['possession_date'] == ''){
            $data['possession_date'] = date('Y-m-d');
        }
        // echo'<pre>';print_r($collateral);exit;
        
        if(isset($data['amenities_id']) && $data['amenities_id'] != ''){
            $amenities = implode(',',$data['amenities_id']);
            $data['amenities_id'] = $amenities;
        }
        else{
            $data['amenities_id'] = '';
        }
        
        if(isset($data['configuration']) && $data['configuration'] != ''){
            $amenities = implode(',',$data['configuration']);
            $data['configuration'] = $amenities;
        }
        else{
            $data['configuration'] = '';
        }

        $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';
        $API['lid'] = '2';
        $data['Pid'] = '0';

        $Jsondata = json_encode($API);
        $url = 'https://net4hoh.sperto.co.in/_api/api_auth_project_list.php';
        $Result = $this->CallApi($Jsondata,$url);
        if($Result->status == 'success'){
            foreach ($Result->data as $value) {
                if($value->project_name == $data['project_name']){
                    $data['Pid'] = $value->project_id ;
                }
                // code...
            }
        }
        $request->validate([
            'project_name' => 'required',
            'configuration' => 'required',
            'price' => 'required',
            'rera_certificate' => 'mimes:jpeg,bmp,png,gif,svg,pdf',
            'hero_image' => 'mimes:jpeg,bmp,png,svg|max:2048',
            'files.*' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        if($request->hasfile('rera_certificate'))
        {
            $reraname = $request->file('rera_certificate');
            $reraext =  $reraname->getClientOriginalExtension();
            $rerafilename = time().'.'.$reraext;
            $location = 'projects/'.str_replace(' ','_',$data['project_name']).'/ReraCertificate';
            $reraname->move($location,$rerafilename);
            $rerapath = 'projects/'.str_replace(' ','_',$data['project_name']).'/ReraCertificate/'.$rerafilename;
            $data['rera_certificate_path'] = $rerapath;
        }
        if($request->hasfile('hero_image'))
        {
            $heroname = $request->file('hero_image');
            $herofilename = time().'.jpg';
            $location = 'projects/'.str_replace(' ','_',$data['project_name']).'/HeroImage';
            $heroname->move($location,$herofilename);
            $heropath = 'projects/'.str_replace(' ','_',$data['project_name']).'/HeroImage/'.$herofilename;
            $data['hero_image_path'] = $heropath;
        }
        
       
        
        
        //$project_insert = project::create($data);

       
        $return_data['last_inserted_id'] = $project->id;
        $return_data['project_name'] = $project->project_name;
        $project->fill($data)->save();
       


        if(isset($data['collateral_array']) && $data['collateral_array'] > 0)
            return $return_data;
        else{
            session(['success'=>'Project has been updated successfully.']);
            return response()->json(['status'=>'success','message'=>'Project has been updated successfully.',"redirect_url"=>url('project')]);
            //return redirect()->route('project.index')->with('success','Project has been created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success','Project has been deleted successfully');
    }

    public function ZipFile($id)
    {
        
        $projectName = DB::table('project')
                    ->select('project_name','rera_certificate_path','hero_image_path')
                    ->where('id','=',$id)
                    ->get();
        //print_r($projectName);exit;
        $project = DB::table('map_collateral_image')
                    ->select('path')
                    ->join('project_collateral','map_collateral_image.project_collateral_id','=','project_collateral.id')
                    ->where('project_collateral.project_id','=',$id)
                    ->get(); 
        
        if(count($project) > 0 || $projectName[0]->rera_certificate_path != '' || $projectName[0]->hero_image_path != ''){
            $zip = new ZipArchive;
            $fileName = 'image.zip';
        
            if(File::exists(public_path('image.zip'))){
                File::delete(public_path('image.zip'));
            }
        

            //$zip->open($fileName, \ZipArchive::CREATE);
            if($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
            {
                $files = File::files(public_path('projects/'.$projectName[0]->project_name.'/'));
                if(count($project) > 0){
                    foreach($project as $key => $value){
                        //echo $value->path.'<br>';
                        $relativeNameInZipFile = basename($value->path);
                        $zip->addFile($value->path,$value->path);
                    }
                }

                if($projectName[0]->hero_image_path != ''){
                    $relativeNameInZipFile = basename($projectName[0]->hero_image_path);
                    $zip->addFile($projectName[0]->hero_image_path,$projectName[0]->hero_image_path);
                }

                if($projectName[0]->rera_certificate_path != ''){
                    $relativeNameInZipFile = basename($projectName[0]->rera_certificate_path);
                    $zip->addFile($projectName[0]->rera_certificate_path,$projectName[0]->rera_certificate_path);
                }
                $zip->close();
            }

            
            return response()->download(public_path($fileName));
        }
        else{
            return redirect()->route('project.index')->with('success','No Project Collateral Found.');
        }
    }
    
    public function StatusUpdate($id)
    {
       $project = DB::table('project')
                    ->select('is_active')
                    ->where('id','=',$id)
                    ->first();

        //print_r($project);exit;
        if($project->is_active == '1'){
            $is_active = '0';
        }
        else{
            $is_active = '1';
        }

        $values = array('is_active'=> $is_active);

        DB::table('project')->where('id',$id)->update($values);

        return redirect()->route('project.index')->with('success','Project status has been updated successfully.');
    }
}
