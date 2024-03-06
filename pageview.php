<?php

$pixelId = '788385176470510';
$accessToken = 'EAATAnEQbIskBOZC7flg8NY5UCY8ZCt6uHz2CZBrn135OdSDbj1NT2fHDglpAxV0MI3fSZA6z97zpcUCoc8NqITIlmk9tk4Iw5t4nHIKD7rx7DnWUa62oX1ZAwrzVsX4u1i6v7ERcBQz1FXLaHNJZB9iQfnKmOFYc82DlT2tKNneu1VvcgGEoqZCkaKwPgf9RQVaOQZDZD';
$url = "https://graph.facebook.com/v11.0/$pixelId/events";



$data = [
    'data' => [
        [
            'event_name' => 'Pageview',
            'event_time' => time(),
            'action_source' => 'website',
            'event_source_url' => 'https://drbacteria.com/',
            'user_data' => [
                'client_ip_address' => $_SERVER['REMOTE_ADDR'],
                'client_user_agent' => $_SERVER['HTTP_USER_AGENT'],
            ],
        ],
    ],
    'access_token' => $accessToken,
];


$jsonData = json_encode($data);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);
