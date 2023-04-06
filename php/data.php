<?php 
    // recuperer file JSON en php
    $json_array = file_get_contents('http://localhost/message/img/photo.json');
    $array = json_decode($json_array);

    // changer en format JSON
    echo json_encode($array, true);

?>