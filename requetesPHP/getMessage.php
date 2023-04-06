<?php 

    namespace requetesPHP\getMessage;

    require_once "Class_message.php";

    use requetesPHP\class_messages\Messages as Messages;
     
    $m1 = new Messages();

    // recupere tous les messages
    $message = $m1->findAll();
    echo json_encode($message, true);

?>