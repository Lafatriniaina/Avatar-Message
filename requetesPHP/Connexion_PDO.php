<?php

    namespace requetesPHP\Connexion_PDO;
 
    use PDO;
    use PDOException;
    
    class Database extends PDO {
        //instance de la class
        public static $instance;
        
        //connecter au BDD
        public const DBHOST = 'localhost';
        public const DBUSER = 'User';
        public const DBPASS = '';
        public const DBNAME = 'inscription';

        public function __construct()
        {

            $pdo_connection = 'mysql:host='.self::DBHOST.';dbname='.self::DBNAME;
    
            try {
                parent::__construct($pdo_connection, self::DBUSER, self::DBPASS);

                $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf-8');
                $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {$e->getMessage();}

        }

        public static function getInstance():self {
            if (self::$instance === null) {
                self::$instance = new self();
            }
            return self::$instance;
        }
       
    }
?>