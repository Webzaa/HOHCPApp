<?php

namespace App\Http\Controllers;

use App\Models\lead;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use DB;

class leadController extends Controller
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
           
    
         $lead = DB::table('lead')
                    ->select('lead.*','project_name','cp_name')
                    ->join('channel_partner','channel_partner.id','=','lead.cp_id')
                    ->join('project','project.id','=','lead.project_id')
                    ->orderBy('id', 'DESC')
                    ->paginate(100);

        $data['lead'] = $lead;
        return view('lead.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'lead_name' => 'required'
        ]);
        
        lead::create($request->post());

        return redirect()->route('lead.index')->with('success','lead has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(lead $lead)
    {
        return view('lead.show',compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit(lead $lead)
    {
        return view('lead.edit',compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lead $lead)
    {
        
        //echo'<pre>';print_r($lead);exit;
        
        $request->validate([
            'lead_name' => 'required'
        ]);
        
        $lead->fill($request->post())->save();

        return redirect()->route('lead.index')->with('success','lead Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy(lead $lead)
    {
        $lead->delete();
        return redirect()->route('lead.index')->with('success','lead has been deleted successfully');
    }

    public function StatusUpdateApproved($id)
    {
      

        
        $lead_otp = DB::table('lead')->select('uniqueid','name','email','mobile','project_id','cp_id')->where('id',$id)->get();
                
        $Project = DB::table('project')->select('integrations','lead_category','campaign_key')->where('id','=',$lead_otp[0]->project_id)->get();

        $ChannelPartner = DB::table('channel_partner')->select('mobile')->where('id','=',$lead_otp[0]->cp_id)->get();

        

        // if($is_active == '1'){
        //     $message ='Congratulations you are now a registered partner with House of Hiranandani. Go ahead and add leads to begin your journey.';
        //     $mobile = $channel_partner->mobile;
        //     $templateID = '1507167099710202829';
        //     $SMS = $this->SendSMS($mobile,$message,$templateID,'HIRANA');
        // }
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
        $API['guid'] = $lead_otp[0]->uniqueid;
        $url = 'https://net4hoh.sperto.co.in/_api/api_auth_post_lead_json.php';
        
        $Jsondata = json_encode($API);
        $API = $this->CallApi($Jsondata,$url);
    
        $update_lead = DB::table('lead')
        ->where('id',$id)
        ->update(['HOH_uniqueid' => $API->message,'is_verified'=> 'Approved']);

        //dd($API);
        //dd($update_lead);
        return redirect()->route('lead.index')->with('success','Lead status has been updated successfully.');

    }


    public function StatusUpdateRejected($id)
    {
      
      
        $values = array('is_verified'=> 'Rejected');

        DB::table('lead')->where('id',$id)->update($values);

        // if($is_active == '1'){
        //     $message ='Congratulations you are now a registered partner with House of Hiranandani. Go ahead and add leads to begin your journey.';
        //     $mobile = $channel_partner->mobile;
        //     $templateID = '1507167099710202829';
        //     $SMS = $this->SendSMS($mobile,$message,$templateID,'HIRANA');
        // }

        return redirect()->route('lead.index')->with('success','Lead status has been updated successfully.');
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
