<?php 

    namespace requetesPHP\deleteMessage;

    require_once('Class_Personnes.php');
    require_once('Class_message.php');

    use requetesPHP\class_messages\Messages as Messages;
    use requetesPHP\Connexion_PDO\Database;

    include_once "Connexion_PDO.php";

    $ddb = new Database();
    $db = $ddb->getInstance();
    $m1 = new Messages($db);

    // header requis
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $donnee = json_decode((file_get_contents("php://input")));
        $messageSupprrimer = $m1->setIdMessage($donnee->idMessages);
        
        $m1->delete($donnee->idMessages);

        if(empty($messageSupprrimer)) {

            http_response_code(200);
            echo "reussi";
        } else{
            http_response_code(404);
        }
        
    } else {
        http_response_code(404);
        echo json_encode(["message" => "requete non autorisée"]);
    }
    //json_encode($messageSupprrimer, true);
    // $m1->delete(12);

?>