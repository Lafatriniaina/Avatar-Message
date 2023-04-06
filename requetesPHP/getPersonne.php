<?php 

    namespace requetesPHP\getPersonne;
    require_once('./Class_Personnes.php');
    
    use requetesPHP\class_personnes\Personnes as Personnes;
   
    require_once('./requetePDO.php');
    $p1 = new Personnes();

  
    $personne = $p1->findAll();
    echo json_encode($personne, true);

?>