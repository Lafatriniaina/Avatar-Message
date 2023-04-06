<?php 

    namespace requetesPHP\curlCreateMessage;

    require_once "createMessage.php";
    require_once "Class_message.php";
    function createMessage($idMessages, $Date, $mpMoi, $idPersonne) 
    {
        $url = "http://localhost/message/requetesPHP/createMessage.php"; 
        $data = array("idMessages"=>$idMessages, "Date"=>$Date, "mpMoi"=>$mpMoi, "idPersonne"=>$idPersonne);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $reponse = curl_exec($ch);
        curl_close($ch);

        return $reponse;
    
    }
?>