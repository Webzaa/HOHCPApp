<?php 


function APICALL($url,$data){

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
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),

    ));

    

    $response = curl_exec($curl);    

    curl_close($curl);

    return json_decode($response);
}

function send_notification($response_array){
        
  $url = 'https://api2.pushassist.com/notifications/';
  
  $headers = array(
    'X-Auth-Token: hbtDyfEHkvdjjSiuLx6E380Eq1FkB6dE',
    'X-Auth-Secret: Wmn51RajEPKtDNjXaLxn8HGJDDhq',
    'Content-Type: application/json'
  );
   
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response_array));
  curl_setopt($ch, CURLOPT_SSLVERSION, 4);
  $result = curl_exec($ch);

  if ($result === FALSE) {
    die('Curl failed: ' . curl_error($ch));
  }
  
  curl_close($ch);

  $result_arr = json_decode($result, true);
  
  return $result_arr;
}

?>