<?php
    namespace requetesPHP\class_messages;
    require_once('./requetePDO.php');
    require_once('./Connexion_PDO.php');

use requetesPHP\requetePDO\requetes as requetes;
use DateTime;

    class Messages extends requetes {
        public $idMessages;
        public $Date;
        public $MpMoi;
        public $idPersonne;

     

        public function __construct() 
        {
            $this->table = 'messages';
            $this->bdd = self::DBNAME;
        }
        
        public function getIdMessage():int {
            return $this->idMessages;
        }
        /** 
        * definir la valeur de l'id du message
        * @return self
        */
        public function setIdMessage(int $idMessage):self {
            $this->idMessages = $idMessage;
            return $this;
        }
        
        public function getDate():DateTime {
            return $this->Date;
        }
        /**
         * definir la Date
         * @return self
         */
        public function setDate(DateTime $Date):self {
            $this->Date = $Date;
            return $this;
        }

        public function getMpMoi():string {
            return $this->MpMoi;
        }
         /**
         * definir la valeur de numero
         * @return self
         */
        public function setMpMoi(string $MpMoi):self {
            $this->MpMoi = $MpMoi;
            return $this;
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

    }
?>