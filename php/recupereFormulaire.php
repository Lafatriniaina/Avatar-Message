<?php
// si le formulaire existe sur la base de données on les récupère

    try {

        $mysql = new PDO('mysql:host=localhost;dbname=inscription', 'User','');
        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['pass'])) {

            $nomExist = $_POST['nom'];
            $prenomExist = $_POST['prenom'];
            $codeExist = $_POST['pass'];
          
            // verifions si l'utilisateur existe déjà dans la bdd
            $query = "SELECT * FROM personnes WHERE nom = :Nom AND prenom =:Prenom AND pass = :Code";
            $statment = $mysql->prepare($query);
            $statment->bindParam(":Nom", $nomExist);
            $statment->bindParam(":Prenom", $prenomExist);
            $statment->bindParam(":Code", $codeExist);
            $reussi = $statment->execute();
           
            if ($statment->rowCount() > 0) {
                session_start();
                
                $_SESSION["Nom"] = $nomExist;
                $_SESSION["Prenom"] = $prenomExist;
                $_SESSION["Code"] = $codeExist;
                if ($reussi) {
                    header("Location: accueil.php?nomMoi=".$_SESSION["Nom"]."&prenomMoi=".$_SESSION["Prenom"]);
                }
            } else if (isset($_GET["error"])) {
                header("Location: accesFormulaireExist.html?error=Cette personne n'existe pas!" .$_GET["error"]);
            }
        
            } else {
                echo "erreur";
            }

    } catch (PDOException $e) {
        $error_message  = $e->getMessage();
        echo " ".$error_message;
        exit();
    }

    
?>