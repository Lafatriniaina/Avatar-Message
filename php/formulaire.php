<?php 
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero = $_POST['nombre'];
    $password = $_POST['code'];
    $sexe = $_POST['sexe'];

    try {
        $mysql = new PDO('mysql:host=localhost;dbname=inscription', 'User','');
        $insert = $mysql->prepare("INSERT INTO personnes 
        VALUES(NULL, :Nom, :Prenom, :Numero, :Code, :Sexe) ");
        $insert->bindValue(':Nom', $nom, PDO::PARAM_STR);
        $insert->bindValue(':Prenom', $prenom, PDO::PARAM_STR);
        $insert->bindValue(':Numero', $numero, PDO::PARAM_INT);
        $insert->bindValue(':Code', $password, PDO::PARAM_STR);
        $insert->bindValue(':Sexe', $sexe, PDO::PARAM_STR);

        $executeRequest = $insert->execute();

            if ($executeRequest) {
                include_once('photo.php');
            } else {
                throw new Exception($e);
                header("location: formulaire.php?" . $e->message());
                die();
            }
       
    }   
 
    catch (PDOException $e) {
        $error_message  = $e->getMessage();
        echo " ".$error_message;
        exit();
    }

?>
