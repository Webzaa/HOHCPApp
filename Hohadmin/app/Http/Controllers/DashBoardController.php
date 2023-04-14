<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
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

    public function index()
    {   
        //dd(Auth::user()->roles());

        $role_id = DB::table('users_roles')
                    ->select('role_id')
                    ->where('users_roles.user_id','=',Auth::user()->id)
                    ->get();

        if(count($role_id) > 0 && $role_id[0]->role_id == '1'){
            $cp_id =  DB::table('channel_partner')
                           ->select('channel_partner.cp_id','cp_name')
                           ->get();

            $lead_count = 0;  
            $booking_count = 0;   
            $leadbyCP = array();           
            foreach ($cp_id as  $value) {

                
                $API['cpid'] = $value->cp_id;
                $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';                  
                $Jsondata = json_encode($API); 

                ## Get Lead count 
                $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_leads.php'; 
                $Data = $this->CallApi($Jsondata,$url); 
                $lcount = 0;
                if($Data->status == 'success'){
                    $lcount = count($Data->data);
                    $lead_count = $lead_count + count($Data->data);
                }

                array_push($leadbyCP, array('name'=> $value->cp_name,'y'=> (int)$lcount));

                ## Get  Booking count
                $bookurl = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_book_unit.php';
                $BData = $this->CallApi($Jsondata,$bookurl);

                if($BData->status == 'success'){
                    $booking_count = $booking_count + count($BData->data);
                }
            }
        }

        else{
            // $sm_id = DB::table('sales_manager')
            //         ->select('id')
            //         ->where('sales_manager.email_id','=',Auth::user()->email)
            //         ->get();
            
            $cp_id =  DB::table('channel_partner')
                           ->select('channel_partner.cp_id','cp_name')
                           ->join('users','users.email','=','channel_partner.email_id')
                           ->where('users.reporting_to','=', Auth::user()->id)
                           ->get();

                         
            $lead_count = 0;  
            $booking_count = 0;   
            $leadbyCP = array();           
            foreach ($cp_id as  $value) {

                
                $API['cpid'] = $value->cp_id;
                $API['api_key'] = 'WEBZAA-25052022-HDIK7-DGDDT-UITQW';                  
                $Jsondata = json_encode($API); 

                ## Get Lead count 
                $url = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_leads.php'; 
                $Data = $this->CallApi($Jsondata,$url); 
                $lcount = 0;
                if($Data->status == 'success'){
                    $lcount = count($Data->data);
                    $lead_count = $lead_count + count($Data->data);
                }

                array_push($leadbyCP, array('name'=> $value->cp_name,'y'=> (int)$lcount));

                ## Get  Booking count
                $bookurl = 'https://net4hoh.sperto.co.in/_api/api_auth_cp_book_unit.php';
                $BData = $this->CallApi($Jsondata,$bookurl);

                if($BData->status == 'success'){
                    $booking_count = $booking_count + count($BData->data);
                }
            }
        }
        
             


                
                return view('Dashboard.index', [
                   'lead_count' => $lead_count,
                   'booking_count' => $booking_count,
                   'leadbyCP' => json_encode($leadbyCP)
            
                ]);
           
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
