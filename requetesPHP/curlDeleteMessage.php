<?php 

    namespace requetesPHP\curlDeleteMessage;

    require_once "deleteMessage.php";

    $ch = curl_init();
    $url = "http://localhost/message/requetesPHP/deleteMessage.php";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    $response = curl_exec($ch);
    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        $decodeJson = json_decode($response, true);
        print_r($decodeJson);
    }

    curl_close($ch);

?>