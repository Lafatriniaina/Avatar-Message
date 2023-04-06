<?php
    namespace requetesPHP\class_personnes;
    require_once('./requetePDO.php');
    require_once('./Connexion_PDO.php');
    use requetesPHP\requetePDO\requetes as requetes;

    class Personnes extends requetes {
        protected $idPersonne;
        protected $Nom;
        protected $Prenom;
        protected $Numero;
        protected $Code;
        protected $Sexe;

        public function __construct() 
        {
            $this->table = 'personnes';
            $this->bdd = 'inscription';
        }
    
        public function getId():int {
            return $this->idPersonne;
        }
        /** 
        * definir la valeur de l'id du personne
        * @return self
        */
        public function setId(int $idPersonne):self {
            $this->idPersonne = $idPersonne;
            return $this;
        }
        
        public function getNom():string {
            return $this->Nom;
        }
        /**
         * definir la valeur de nom
         * @return self
         */
        public function setNom(string $Nom):self {
            $this->Nom = $Nom;
            return $this;
        }

        public function getPrenom():string {
            return $this->Prenom;
        }
         /**
         * definir la valeur de numero
         * @return self
         */
        public function setPrenom(string $Prenom):self {
            $this->Prenom = $Prenom;
            return $this;
        }

        public function getNumero():int {   
            return $this->Numero;
        }
        /**
         * definir la valeur de numero
         * @return self
         */
        public function setNumero(string $Numero):self {
            $this->Numero = $Numero;
            return $this;
        }

        public function getCode():int {   
            return $this->Code;
        }
        /**
         * definir la valeur de mot de pass
         * @return self
         */
        public function setCode(int $Code):self {
            $this->Code = $Code;
            return $this;
        }

        public function getSexe():string {   
            return $this->Sexe;
        }
        /**
         * definir la valeur de mot de pass
         * @return self
         */
        public function setSexe(string $Sexe):self {
            $this->Sexe = $Sexe;
            return $this;
        }

    }
   
?>