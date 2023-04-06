<?php 

    namespace requetesPHP\updateMessage;

    require_once('Class_message.php');
    require_once('Class_Personnes.php');

    use requetesPHP\class_messages\Messages as Messages;
    use requetesPHP\Connexion_PDO\Database;

    include_once "Connexion_PDO.php";
    
    $ddb = new Database();
    $db = $ddb->getInstance();
    $m1 = new Messages($db);


    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: PUT");
    header("Content-Type: application/json; charset=UTF-8");
    
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $updateMessage = json_decode((file_get_contents("php://input")));
        
        $messageAjour = $m1 
            ->setIdMessage($updateMessage->idMessages)
            ->setMpMoi($updateMessage->MpMoi)
            ->setId($updateMessage->idPersonne);

        echo json_encode($messageAjour, true);
        $array = [];
        $array[] = [$messageAjour];
        $hydrate = $m1->hydrate($array);
        $m1->updateMessage($updateMessage->idMessages, $hydrate);


    } else {
        http_response_code(404);
        echo json_encode(["message" => "requête non autorisée"]);
    }    


?>