<?php  
    $mysql = new PDO('mysql:host=localhost;dbname=inscription', 'User','');
    // recuperer les noms et prenoms existants dans la BDD
    $exec = $mysql->prepare("SELECT DISTINCT idPersonne,Nom,Prenom FROM personnes ORDER BY IdPersonne DESC");
    $resultat = $exec->execute();
    $nbr_pers = $exec->fetchAll();
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/message/jry&boots/css/font-awesome.min.css">
    <link rel="stylesheet" href="../jry&boots/css/bootstrap.min.css">
    <script src="../jry&boots/js/jquery-3.6.2.min.js"></script>
    <title>Document</title>
</head>

<style>
    body {
        background-color: rgba(111, 111, 111, 0.1);
    }

    #liste-amis {
        max-height: 140px;
        display: flex;
        overflow-x: auto;
        background-color: white;
    }

    #liste-amis .row.col-2.btn-group-vertical {
        width: 90px;
        height: 130px;
        line-height: 110px;
        text-align: center;
        justify-content: center;
        background-color: white;
        margin: 1px;
    }

    .personne, .actifs {
        background-color: rgba(255, 255, 255, 0.3);
    }
    
    div p {
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        margin-left: 20px;
    }

    .photo, .nom-prenom, .message, .actifs {
        border: none;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .photo {
        height: 100%;
    }

</style>

<body>
    <div class="container-fluid">
        <div class="tete-nav p-3 btn-group-horizontal d-flex justify-content-between">
            <div class="parametre row-1 col-2 m-1 d-flex flex-direction-row justify-content-center">
                <a href="../html/parametre.html"><img src="../img/img/settings.png" alt="setting" width="20px" height="20px"></a>
            </div>
            <div class="titre">
                <h2>Messages</h2>
            </div>
            <div class="rechercher row-1 col-2 m-1 d-flex flex-direction-row justify-content-center">
                <img src="../img/img/sun.png" alt="sun" width="20px" height="20px">
            </div>
        </div>
    </div>

    <div>
        <p>Actifs</p>
    </div>
    <hr>
    <div class="col d-left" id="liste-amis">
    <!--recuperer puis afficher tous les listes des actifs-->
    </div>
    <hr>
    <div>
        <p>Discussions</p>
    </div>

    <div class="col" id="discussion">
        <!-- recuperer puis afficher tous les discussions -->
    </div>

                  
    
</body>
  
<script> 
    
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    const nomMoi = urlParams.get("nomMoi");
    const prenomMoi = urlParams.get("prenomMoi");
    sessionStorage.setItem('nomMoi', prenomMoi);

    var liste_amis = document.getElementById('liste-amis');
    var discussion = document.getElementById('discussion');

    window.onload = function() {
        var nomPhoto = localStorage.getItem("nom");
        var photo = localStorage.getItem("photo");

        addImage(photo);
        function addImage(imageListe) {
            var image = [];
            image.push(imageListe);

            for (var i = 1; i < image.length; i++) {
                var imageArrayLists = {
                    "id": i,
                    "photo": imageListe
                };
                console.log(JSON.stringify(imageArrayLists));
            }
        

        }            

    <?php
        $nom = $_GET["nomMoi"];
        $prenom = $_GET["prenomMoi"];
    ?>
    
    // recuperer puis afficher tous les listes des actifs
    liste_amis.innerHTML = `
    <?php 
            foreach($nbr_pers as $personne) { ?>
            <?php if (($personne['Nom'] != $nom && $personne['Prenom'] != $prenom)) { ?>
            <div class="row col-2 btn-group-vertical bg-light shadow-sm card actifs">
                <button class="col container-lg border-0 px-0 card personne" data="<?=$personne["idPersonne"]?>" data-name="<?=$personne["Nom"]?>">
                    <div class="col m-1 justify-center">
                        <div class="row-lg col-2 h6 d-flex flex-direction-row">
                            <img src="http://localhost/message/img/chat.jpg" alt="avatar" class="rounded-circle" width="600%" height="600%">
                        </div>

                        <div class="row-1 col-2 h6 d-flex flex-direction-row">
                            <?= $personne['Nom']?>
                        </div>
                    </div>
                </button>
            </div>
        <?php } }?>
    `;
  
    // recuperer puis afficher tous les discussions
    discussion.innerHTML = ` 
        <?php 
            foreach($nbr_pers as $personne) {?>
                <?php if ($personne['Nom'] == $nom && $personne['Prenom'] == $prenom) { ?>
              
                    <div class="container-fluid my-1">
                        <button class="row container-lg border-0 mx-0 justify-center personne shadow-sm" data-id="<?=$personne["idPersonne"]?>" data-nom="<?=$personne["Nom"]?>">
                            <div class="row-lg-2 row-md-2 row-sm-2 col-2 h6 justify-content-center photo">
                                <img src="${photo}" alt="avatar" class="rounded-circle" width="60%" height="60%">
                            </div>
                            <div class="col">
                                <div class="col-lg row-1 m-1 card nom-prenom">
                                    <?= $personne['Nom']." ".$personne['Prenom']?> 
                                </div>
                                <div class="col-lg row-1 m-1 my-3 card message">
                                    lorem upsum
                                </div> 
                            </div> 
                        </button>  
                    </div>

                <?php } else { ?>

                    <div class="container-fluid my-1">
                    <button class="row container-lg border-0 mx-0 justify-center personne shadow-sm" data-id="<?=$personne["idPersonne"]?>" data-nom="<?=$personne["Nom"]?>">
                        <div class="row-lg-2 row-md-2 row-sm-2 col-2 h6 justify-content-center photo">
                            <img src="http://localhost/message/img/chat.jpg" alt="avatar" class="rounded-circle" width="60%" height="60%">
                        </div>
                        <div class="col">
                            <div class="col-lg row-1 m-1 card nom-prenom">
                                <?= $personne['Nom']." ".$personne['Prenom']?> 
                            </div>
                            <div class="col-lg row-1 m-1 my-3 card message">
                                lorem upsum
                            </div> 
                        </div> 
                    </button>  
                    </div>

        <?php }}?>
    `;

    
    

    var personne = document.querySelectorAll(".personne");

        personne.forEach(function(btnPersonne) {
            btnPersonne.addEventListener("click", function() {
                var idPersonne = this.getAttribute("data-id");
                var nomPersonne = this.getAttribute("data-nom");
                sessionStorage.setItem("idPersonne", + idPersonne);
                sessionStorage.setItem("nomPersonne", + nomPersonne);

                var url = "../html/message.html?idPersonne=" + encodeURIComponent(idPersonne) + "&nomPersonne=" + encodeURIComponent(nomPersonne);

                window.location.href = url;
            });
        });


        var actifs = document.querySelectorAll(".actifs");

        actifs.forEach(function(btnPersonne) {
            btnPersonne.addEventListener("click", function() {
                var idPersonne = this.getAttribute("data");
                var nomPersonne = this.getAttribute("data-name");
                sessionStorage.setItem("idPersonne", + idPersonne);
                sessionStorage.setItem("nomPersonne", + nomPersonne);

                var url = "../html/message.html?idPersonne=" + encodeURIComponent(idPersonne) + "&NomPersonne=" + encodeURIComponent(nomPersonne);

                window.location.href = url;
            });
        });

    }

</script>
<script src="../scripts/accueil.js"></script>

</html>