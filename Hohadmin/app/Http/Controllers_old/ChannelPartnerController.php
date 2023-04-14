<?php

namespace App\Http\Controllers;

use App\Models\ChannelPartner;
use App\Models\project;
use App\Models\MapCPProjects;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ChannelPartnerController extends Controller
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
            $ChannelPartner = ChannelPartner::where('cp_name','LIKE','%'.$search.'%')->orWhere('email_id','LIKE','%'.$search.'%')->orWhere('mobile','LIKE','%'.$search.'%')->orWhere('address','LIKE','%'.$search.'%')->orWhere('departments','LIKE','%'.$search.'%')->limit(5)->get();
        }
        else{
            $ChannelPartner = ChannelPartner::orderBy('id','desc')->paginate(5);
        }
        session(['success'=>'']);
        return view('ChannelPartner.index', compact('ChannelPartner','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = project::all();
        return view('ChannelPartner.create', [
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
        
       
        $request->validate([
            'cp_name' => 'required',
            'email_id' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        
        if($request->hasfile('rera_certificate_path'))
        {
            $reraname = $request->file('rera_certificate_path');            
            $reraext =  $reraname->getClientOriginalExtension();
            $rerafilename = time().'.'.$reraext;
            
            $location = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/ReraCertificate';
            $reraname->move($location,$rerafilename);
            $rerapath = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/ReraCertificate/'.$rerafilename;
            $data['rera_certificate_path'] = $rerapath;
        }

        
        if($request->hasfile('gst_certificate_path'))
        {
            $gstname = $request->file('gst_certificate_path');            
            $gstext =  $gstname->getClientOriginalExtension();
            $gstfilename = time().'.'.$gstext;
            $location = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/GSTCertificate';
            $gstname->move($location,$gstfilename);
            $heropath = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/GSTCertificate/'.$gstfilename;
            $data['gst_certificate_path'] = $heropath;
        }
        
        $channel_partner = ChannelPartner::create($data);
        $last_insert_id = $channel_partner->id;

        if(isset($data['projects'])){
            $i = 0;
            foreach($data['projects'] as $value){
                $insert[$i]['cp_id'] =  $last_insert_id;
                $insert[$i]['project_id'] = $value;
                
                $i++;
            }
        }
        MapCPProjects::insert($insert);
        

       
        User::create([
           'name' => $data['cp_name'],
           'email' => $data['email_id'],
           'role_id' => '2',
           'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('ChannelPartner.index')->with('success','Channel Partner has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChannelPartner  $channelPartner
     * @return \Illuminate\Http\Response
     */
    public function show(ChannelPartner $channelPartner)
    {
        return view('channelPartner.show',compact('channelPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChannelPartner  $channelPartner
     * @return \Illuminate\Http\Response
     */
    public function edit(ChannelPartner $ChannelPartner)
    {
        
        $MapProjectCP = DB::table('map_project_cp')
        ->select('map_project_cp.id','map_project_cp.project_id','map_project_cp.cp_id')
        ->where('map_project_cp.cp_id', '=', $ChannelPartner->id)
        ->groupBy('cp_id','project_id')
        ->get();
        $data = project::all();
        return view('channelPartner.edit', [
            'all_projects' => $data,
            'MapProjectCP' => $MapProjectCP,
            'ChannelPartner'=> $ChannelPartner
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChannelPartner  $channelPartner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChannelPartner $ChannelPartner)
    {
       
        $data = $request->post();
       

        
        if($request->hasfile('rera_certificate_path'))
        {
            $reraname = $request->file('rera_certificate_path');            
            $reraext =  $reraname->getClientOriginalExtension();
            $rerafilename = time().'.'.$reraext;
            
            $location = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/ReraCertificate';
            $reraname->move($location,$rerafilename);
            $rerapath = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/ReraCertificate/'.$rerafilename;
            $data['rera_certificate_path'] = $rerapath;
        }

        
        DB::table('map_project_cp')->where('cp_id', $ChannelPartner->id)->delete();

        if(isset($data['projects'])){
            $i = 0;
            foreach($data['projects'] as $value){
                $insert[$i]['cp_id'] =  $ChannelPartner->id;
                $insert[$i]['project_id'] = $value;
                
                $i++;
            }
            MapCPProjects::insert($insert);
        }    
        if($request->hasfile('gst_certificate_path'))
        {
            $gstname = $request->file('gst_certificate_path');            
            $gstext =  $gstname->getClientOriginalExtension();
            $gstfilename = time().'.'.$gstext;
            $location = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/GSTCertificate';
            $gstname->move($location,$gstfilename);
            $heropath = 'ChannelPartnerImages/'.$data['cp_name'].'_'.$data['mobile'].'/GSTCertificate/'.$gstfilename;
            $data['gst_certificate_path'] = $heropath;
        }
        
        //echo '<pre>';print_r($data);exit;
       
         $request->validate([
            'cp_name' => 'required',
            'email_id' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        
         $ChannelPartner->fill($data)->save();

        return redirect()->route('ChannelPartner.index')->with('success','Channel Partner Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChannelPartner  $channelPartner
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChannelPartner $channelPartner)
    {
        $channelPartner->delete();
        return redirect()->route('channelPartner.index')->with('success','Channel Partner has been deleted successfully');
    }


    public function StatusUpdate($id)
    {
       $channel_partner = DB::table('channel_partner')
                    ->select('is_active')
                    ->where('id','=',$id)
                    ->first();

        //print_r($project);exit;
        if($channel_partner->is_active == '1'){
            $is_active = '0';
        }
        else{
            $is_active = '1';
        }

        $values = array('is_active'=> $is_active);

        DB::table('channel_partner')->where('id',$id)->update($values);

        return redirect()->route('ChannelPartner.index')->with('success','Channel partner status has been updated successfully.');
    }
}
