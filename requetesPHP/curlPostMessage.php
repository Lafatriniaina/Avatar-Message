<?php 

    namespace requetesPHP\curlPostMessage;

use function requetesPHP\postMessage\recupererId;

    require_once "postMessage.php";

    
    $ch = curl_init();
    
    $urlPost = header("Location: http://localhost/message/requetesPHP/postMessage.php/");

    curl_setopt($ch, CURLOPT_URL, $urlPost);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $reponse = curl_exec($ch);

    if ($e = curl_error($ch)) {
        echo $e;
    } else {
        $decode = json_decode($reponse, true);
        print_r($decode);
    }

    curl_close($ch);

?>