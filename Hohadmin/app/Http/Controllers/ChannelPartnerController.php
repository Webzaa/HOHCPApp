<?php

namespace App\Http\Controllers;

use App\Models\ChannelPartner;
use App\Models\project;
use App\Models\SalesManager;
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
            $ChannelPartner = ChannelPartner::where('cp_name','LIKE','%'.$search.'%')->orWhere('email_id','LIKE','%'.$search.'%')->orWhere('mobile','LIKE','%'.$search.'%')->orWhere('address','LIKE','%'.$search.'%')->orWhere('departments','LIKE','%'.$search.'%')->paginate(500);
        }
        else{
            $ChannelPartner = ChannelPartner::orderBy('id','desc')->paginate(100);
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
            MapCPProjects::insert($insert);
        }
       
        

        if(isset($data['password']) &&  $data['password']  != ''){
            User::create([
            'name' => $data['cp_name'],
            'email' => $data['email_id'],
            'mobile' => $data['mobile'],
            'role_id' => '2',
            'password' => Hash::make($data['password']),
            ]);
        }

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
        $SalesManager = SalesManager::all();
        $data = project::all();
        return view('ChannelPartner.edit', [
            'all_projects' => $data,
            'MapProjectCP' => $MapProjectCP,
            'SalesManager'=> $SalesManager,
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
        return redirect()->route('ChannelPartner.index')->with('success','Channel Partner has been deleted successfully');
    }


    public function StatusUpdate($id)
    {
       $channel_partner = DB::table('channel_partner')
                    ->select('is_active','mobile')
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

        if($is_active == '1'){
            $message ='Congratulations you are now a registered partner with House of Hiranandani. Go ahead and add leads to begin your journey.';
            $mobile = $channel_partner->mobile;
            $templateID = '1507167099710202829';
            $SMS = $this->SendSMS($mobile,$message,$templateID,'HIRANA');
        }

        return redirect()->route('ChannelPartner.index')->with('success','Channel partner status has been updated successfully.');
    }

    public function UpdateCPProjectDetails($id)
    {
       $channel_partner = DB::table('channel_partner')
                    ->select('channel_partner.*')
                    ->get();

        //print_r($project);exit;
        if($channel_partner->is_active == '1'){
            $is_active = '0';
        }
        else{
            $is_active = '1';
        }

        $values = array('is_active'=> $is_active);

        DB::table('channel_partner')->where('id',$id)->update($values);

        if($is_active == '1'){
            $message ='Congratulations you are now a registered partner with House of Hiranandani. Go ahead and add leads to begin your journey.';
            $mobile = $channel_partner->mobile;
            $templateID = '1507167099710202829';
            $SMS = $this->SendSMS($mobile,$message,$templateID,'HIRANA');
        }

        return redirect()->route('ChannelPartner.index')->with('success','Channel partner status has been updated successfully.');
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
}
