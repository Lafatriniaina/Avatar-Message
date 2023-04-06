<?php 

    namespace requetesPHP\postMessage;

    use requetesPHP\Connexion_PDO\Database;
    use requetesPHP\class_messages\Messages as Messages;

    require_once "Class_message.php";
    require_once "./../vendor/autoload.php";
    
   
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    $router = new \Bramus\Router\Router();


    function recupererId(int $id) {
        $ddb = new Database();
        $db = $ddb->getInstance();
        $m1 = new Messages($db);


        $findMessage = $m1->findMessage($id);
        echo json_encode($findMessage, true);
        
    }
 
  
    $router->post('/{id}', Router::class, recupererId(6));

    $router->run();
 
?>