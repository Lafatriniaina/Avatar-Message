<?php
    namespace requetesPHP\requetePDO;
    require_once('./Connexion_PDO.php');
    use requetesPHP\Connexion_PDO\Database;

    class requetes extends Database {
        public $table;
        public  $bdd;
     
    /**
     * @param string 
     * @param array
     * @return PDOstatment|false
     */

    public function requete(string $sql, array $attribut = null) {
        // recupere l'instance de bdd
        $this->bdd = Database::getInstance();

        if($attribut !== null) {
            $query = $this->bdd->prepare($sql);
            $query->execute($attribut); 
            return $query;
        } else {
            return $this->bdd->query($sql);
        }
    }

    /**
     * selectionner tous les enregistrements d'une table
     * @return array
     */
    public function findAll() {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }

    /**
     * @param array 
     * @return array
     */
    public function findBy(array $criteres) {
        $champs = [];
        $valeurs = [];

        foreach($criteres as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }

        // transforme le tableau en chaine de caractere
        $liste_champs = implode(' AND ', $champs);

        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    // la methode findPersonne() recuperera un enregistrement dans la classe personne en fonction de son ID
    /**
     * @param  int 
     * @return array 
     */
    public function findPersonne(int $idPersonne) {
        return $this->requete("SELECT * FROM {$this->table} WHERE idPersonne = $idPersonne")->fetch();
    }

    // la methode findMessage() recuperera un enregistrement dans la classe message en fonction de son ID
    /**
     * @param  int 
     * @return array
     */
    public function findMessage(int $idMessages) {
        return $this->requete("SELECT * FROM {$this->table} WHERE idMessages = $idMessages")->fetch();
    }

    // insertion de données CREATE 
    /**
     * insertion d'un enregistrement suivant un tableau de données
     * @param requetes 
     * @return bool
     */
    public function create(requetes $model) {
        $champs = [];
        $inter = [];
        $valeurs = [];

     
        foreach ($model as $champ => $valeur) {
            if($valeur !== null && $champ !== 'bdd' && $champ !== 'table') {
                $champs[] = $champ;
                $inter[] = '?';
                $valeurs[] = $valeur;
            } 
        }

        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.' )VALUES( '.$liste_inter.')', $valeurs);
    }

    // mise à jour d'un enregistrement d'un message suivant un tableau de données
    /**
     * @param int 
     * @param requetes 
     * @return boolean
     */
    public function updateMessage(int $id, requetes $model) {
        $champs = [];
        $valeurs = [];

        foreach ($model as $champ => $valeur) {
            if($valeur !== null && $champ !== 'bdd' && $champ !== 'table') {
                $champs[] = '$champ = ?';
                $valeurs[] = $valeur;
            }
        }

        $valeurs[] = $id;

        return $this->requete('UPDATE '.$this->table.' SET idMessages = ?, MpMoi = ?, idPersonne = ? WHERE idMessages = ?', $valeurs);
    }


     // mise à jour d'un enregistrement d'une personne suivant un tableau de données
    /**
     * @param int 
     * @param requetes 
     * @return boolean
     */
    public function updatePersonne(int $id, requetes $model) {
        $champs = [];
        $valeurs = [];

        // boucler pour eclater le tableau
        foreach ($model as $champ => $valeur) {
            if($valeur !== null && $champ !== 'bdd' && $champ !== 'table') {
                $champs[] = '$champ = ?';
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;

        // transforme le tableau "champs" en chaine de caractere
        $liste_champs = implode(', ', $champs);

        return $this->requete('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE idPersonne = ?'.$valeurs);
    }


    /**
     * suppression d'un enregistrement
     * @param int
     * @return bool
     */
    public function delete(int $id) {
        return $this->requete('DELETE FROM '. $this->table .' WHERE idMessages = ?', [$id]);
    }

    /**
     * hydratation des donnees
     * @param array 
     * @return self
     */
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
        }

        if (method_exists($this, $method)) {
            $this->$method($value);
        }
        return $this;
    }
}
?>