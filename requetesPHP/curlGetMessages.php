<?php 

    namespace requetesPHP\curlGetMessages;

     header("Access-Control-Allow-Origin: *");
     header("Access-Control-Allow-Methods: GET");
     header("Content-Type: application/json; charset=UTF-8");

     
    $ch = curl_init();
    $url = "http://localhost/message/requetesPHP/getMessage.php";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $response = curl_exec($ch);
        if ($e = curl_error($ch)) {
            echo $e;
        } 
        else {
            // return $response;
            $decode = json_decode($response);
            echo json_encode($decode, true);
        }
    } else {
        http_response_code(404);
        echo json_encode(["message" => "reponse non autorisée"]);
    }

    curl_close($ch);
    

?>