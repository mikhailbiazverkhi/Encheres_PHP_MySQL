<?php 
require './database.php';

class User {

    //constructeur
    // public function __construct(    
        // private int $id, 
        // private string $nom,
        // private string $prenom,
        // private string $courriel,
        // private string $login,
        // private string $password
        // )
    // {   
    // }

    //Les méthodes magiques __get et __set

    public function __get($prop){
        if($prop == 'id')
            return $this->id;
        if($prop == 'nom')
            return $this->nom;
        if($prop == 'prenom')
            return $this->prenom;
        if($prop == 'courriel')
            return $this->courriel;
        if($prop == 'login')
            return $this->login;
        if($prop == 'password')
            return $this->password;
    }

    public function __set($prop, $value){
        if($prop == 'id')
            $this->id = $value;
        if($prop == 'nom')
            $this->nom = $value;
        if($prop == 'prenom')
            $this->prenom = $value;
        if($prop == 'courriel')
            $this->courriel = $value;
        if($prop == 'login')
            $this->login = $value;
        if($prop == 'password')
            $this->password = $value;
    }

    public function save(){
        try{
            Database::insertUtilisateur($this->nom, $this->prenom, $this->courriel, $this->login, $this->password);
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
    }
}

?>


