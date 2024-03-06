<?php 
include("get-location.php");

$url = 'https://llapi.leadlovers.com/webapi'; 
$curl = curl_init(); 
$nome = $_POST['complete-name'];
$email = $_POST['email'];
$whatsapp = $_POST['whatsapp'];

$userIP = $_SERVER['REMOTE_ADDR'];
$geoData = getGeoLocation($userIP);

$cidade = $geoData['city'];
$estado = $geoData['region'];

curl_setopt_array($curl, array( 
  CURLOPT_URL => $url . '/lead' . '?token=' . 'E4011EC006134C7D96974566482AC257', 
  CURLOPT_RETURNTRANSFER => true, 
  CURLOPT_ENCODING => '', 
  CURLOPT_MAXREDIRS => 10, 
  CURLOPT_TIMEOUT => 30, 
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
  CURLOPT_CUSTOMREQUEST => 'POST', 
  CURLOPT_POSTFIELDS => 'Email='. $email .'&Name='. $nome .'&MachineCode=723989&EmailSequenceCode=1700686&SequenceLevelCode=1&Phone='. $whatsapp . '&City=' . $cidade . '&State=' . $estado,
  CURLOPT_HTTPHEADER => array( 
    'Content-Type: application/x-www-form-urlencoded' 
  ), 
)); 

$response = curl_exec($curl); 
$err = curl_error($curl); 
echo $nome . ' ' . $email . ' ' . $whatsapp;

curl_close($curl); 

?>
