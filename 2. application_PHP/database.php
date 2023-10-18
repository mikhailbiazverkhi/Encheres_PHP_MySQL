<?php

function query($sql){

    // Database connection paramettres
    $dsn = 'mysql:host=localhost;dbname=enchères';
    $username = 'root';
    $password = '';

    try {

        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$conn = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $stmt = $conn->prepare($sql);
        $stmt->execute();  //1)

        // $stmt->execute([$name, $email, $password]);  // 2)

        // $name =''; $email = '';$password = '';             // 3)
        // // // bind and execute
        // $stmt->bindValue(':name', $name);
        // $stmt->bindValue(':email', $email);
        // $stmt->bindValue(':password', $password);
        // $stmt->execute();


        // $name =''; $email = '';$password = '';             // 4)
        // // bind
        // $stmt->bindParam(1, $name, $email, $password);

        // // set parameters and execute
        // $name ='Mike';
        // $email = 'as.df@bb.cc';
        // $password = '123';
        // $stmt->execute();
        
        return $stmt;

    } catch (PDOException $ex){
        throw $ex;
    }
}

//Database classe
class Database{
    
    public static function insertUtilisateur($nom, $prenom, $courriel, $login, $pass){

        $sql = "INSERT INTO utilisateur VALUES (Default, '$nom', '$prenom', Default, Default, '$courriel', '$login', '$pass')"; // 1)
        
        try{
            query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function selectAllCatégories(){
        $sql = "SELECT * FROM catégorie";
        try{
            return query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function insertObjet($utilisateur_v_id, $nom, $catégorie, $description, $prix_initial, $fin_date, $chemin_photo){

        $sql = "INSERT INTO objet_proposé VALUES (Default, '$utilisateur_v_id', '$nom', '$prix_initial', Default, '$fin_date', '$catégorie', '$description', '$chemin_photo', Default)";
        
        try{
            query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function insertPrixProposé($utilisateur_a_id, $objet_proposé_id, $prix_proposé){

        $sql = "INSERT INTO enchères VALUES (Default, '$utilisateur_a_id', '$objet_proposé_id', '$prix_proposé', Default)";
        
        try{
            query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function maxPrix_Objet_proposé($objet_proposé_id){

        $sql = "SELECT MAX(prix_proposé) FROM enchères WHERE objet_proposé_id = $objet_proposé_id";
        
        try{

            $stmt = query($sql);
            $enchères = $stmt->fetch(PDO::FETCH_NUM); 
            return $enchères[0];

        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function statutObjetVenduUpdate(){
        
        $sql = "UPDATE objet_proposé SET estVendu = TRUE WHERE fin_enchères <= current_timestamp()";
        try{
            query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }

    public static function estLoginUnique($login){

        $sql = "SELECT count(*) FROM utilisateur WHERE login = '$login'";
        try{

            $stmt = query($sql);
            $utilisateur = $stmt->fetch(PDO::FETCH_NUM); 
            if($utilisateur[0] === 0)
                return true;

            return false;
        }catch(PDOException $ex){
            throw $ex;
        }
    }


    public static function insertCommentaire($utilisateur_v_id, $utilisateur_a_id, $note, $commentaire){

        $sql = "INSERT INTO évaluation VALUES (Default, '$utilisateur_v_id', '$utilisateur_a_id', '$note', '$commentaire', Default)";
        
        try{
            query($sql);
        }catch(PDOException $ex){
            throw $ex;
        }
    }
}
?>