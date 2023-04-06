<?php 

    namespace requetesPHP\createMessage;

    require_once('Class_Personnes.php');
    require_once('Class_message.php');

    use requetesPHP\class_messages\Messages as Messages;
    use requetesPHP\Connexion_PDO\Database;

    include_once "Connexion_PDO.php";

    $ddb = new Database();
    $db = $ddb->getInstance();
    $m1 = new Messages($db);
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newMessage = json_decode((file_get_contents("php://input")));
        $messageCreer = $m1 
        ->setMpMoi($newMessage->MpMoi)
        ->setId($newMessage->idPersonne);

        $m1->create($messageCreer);
        echo json_encode($messageCreer, true);

    } else {
        http_response_code(404);
        echo json_encode(["message" => "requête non autorisée"]);
    }
    
?>