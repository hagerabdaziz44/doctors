<?php


namespace App\Http\Services\SMSGateways;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class VictoryLinkSms
{
    public function sendSms($phone, $message)
    {
       
        $service_url =
  'https://rest.gateway.sa/api/SendSMS?api_id=API60445402320&api_password=czkpg4FF2nm2ScC&sms_type=T&encoding=U&sender_id=Monsq&phonenumber='.$phone.'&textmessage='.$message.'';
 $curl = curl_init($service_url);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 $curl_response = curl_exec($curl);
 return $curl_response;
if ($curl_response === false)
if ($curl_response === false) {
$info = curl_getinfo($curl);
curl_close($curl);
die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
 curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status ==
'ERROR') {
die('error occured: ' . $decoded->response->errormessage);
}
    }
}

?>



