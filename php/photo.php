<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/photo.css">
    <link rel="stylesheet" href="../jry&boots/css/bootstrap.min.css">
    <script src="../jry&boots/js/jquery-3.6.2.min.js"></script>
    <title>photo</title>
</head>
<body>
    <div class="titre">
 
        <p class="text-center my-2 isme" data-name="<?= $nom?>" data-first="<?= $prenom?>">Bienvenue <?= $nom.' '.$prenom?> <hr></p>
        <p class="text-center m-2">choisir une photo pour votre profil</p>
      
    </div>
    <div class="row justify-content-center mx-2 container-fluid" id="pdp">
        
    </div>

    <div class="text-center my-5 accepter" id="accepter" style="display: none;">
        <button class="btn btn-success">Je le veut
           
        </button>
    </div>
    
</body>

<script>

    <?php
        require_once "data.php";
    ?>

    var accepter = document.querySelectorAll('.text-center.my-5.accepter'); 

    var photo_pdp = document.querySelector('#pdp');

    //  afficher tous les contenus JSON
    photo_pdp.innerHTML = `
        <?php 
        
        foreach($array as $arrayPhp) { ?>
            <button class="col-2 m-1 card avatarProfil" id="profil" data-nom="<?= $arrayPhp->nom?>" data-photo="<?= $arrayPhp->photo?>">
                <div class="col-3 h-100 w-100 bg-secondary rounded-circle card justify-center photo-profil">
                    <img class="rounded-circle h-100 w-100" src="<?= $arrayPhp->photo?>" class="w-100 h-100">
                </div>
            </button>
        <?php }?>
        `;


$(document).ready(function() {    

    var accepter = document.querySelector(".accepter");
    var profil = document.querySelectorAll('.avatarProfil');

    // recuperer nom et photo a partir d'un évènement clic
    profil.forEach(function(boutton) {
        boutton.addEventListener("click", function() {
            var nomAvatar = this.getAttribute("data-nom");
            var photoAvatar = this.getAttribute("data-photo");

            var estMoi = document.querySelector(".titre .isme");
            var nomMoi = estMoi.getAttribute("data-name");

            accepter.removeAttribute("style");
            accepter.onclick = function() {
                localStorage.setItem("nom", nomAvatar);
                localStorage.setItem("photo", photoAvatar);

                sessionStorage.setItem("nomMoi", nomMoi);
                sessionStorage.setItem("prenomMoi", prenomMoi);

                var url = "accueil.php?nomMoi=" + encodeURIComponent(nomMoi) + "&prenomMoi=" + encodeURIComponent(prenomMoi);
                window.location.href = url;
            }

        })
    })

});

    
</script>

</html>