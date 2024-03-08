<?php
include("get-location.php");

$pixelId = '788385176470510';
$accessToken = 'EAATAnEQbIskBOZC7flg8NY5UCY8ZCt6uHz2CZBrn135OdSDbj1NT2fHDglpAxV0MI3fSZA6z97zpcUCoc8NqITIlmk9tk4Iw5t4nHIKD7rx7DnWUa62oX1ZAwrzVsX4u1i6v7ERcBQz1FXLaHNJZB9iQfnKmOFYc82DlT2tKNneu1VvcgGEoqZCkaKwPgf9RQVaOQZDZD';
$url = "https://graph.facebook.com/v11.0/$pixelId/events";
$userIP = $_SERVER['REMOTE_ADDR'];
$geoData = getGeoLocation($userIP);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['complete-name'] ?? '';
    $email = $_POST["email"] ?? '';
    $telefone = $_POST["whatsapp"] ?? '';

    if (empty($nome) || empty($email) || empty($telefone)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de e-mail inválido.";
        exit;
    }

    $emailHash = hash('sha256', strtolower($email));
    $telefoneHash = hash('sha256', $telefone);
    $nomeHash = hash("sha256", $nome);
    $estadoHash = hash('sha256', $geoData['region']);
    $paisHash = hash('sha256', $geoData['country']);
    $cidadeHash = hash('sha256', $geoData['city']);
    $zipHash = hash("sha256", $geoData['zip']);

    $data = [
        'data' => [
            [
                'event_name' => 'Cadastro',
                'event_time' => time(),
                'action_source' => 'website',
                'event_source_url' => 'https://drbacteria.com/',
                'user_data' => [
                    'em' => $emailHash,
                    'ph' => $telefoneHash,
                    'fn' => $nomeHash,

                    'external_id' => $_SERVER['REMOTE_ADDR'],
                    'client_ip_address' => $_SERVER['REMOTE_ADDR'],
                    'client_user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'fbc' => filter_input(INPUT_COOKIE, '_fbc') ? filter_input(INPUT_COOKIE, '_fbc') : null,
                    'fbp' => filter_input(INPUT_COOKIE, '_fbp'),
                    'st' => $estadoHash,
                    'country' => $paisHash,
                    'ct' => $cidadeHash, 
                    'zp' => $zipHash,
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

    if ($response === false) {
        echo "Erro ao enviar o evento: " . curl_error($ch);
    } else {
        echo "Evento enviado com sucesso: " . $response;
    }

    curl_close($ch);
}
?>
