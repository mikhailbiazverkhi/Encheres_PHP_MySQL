<?php
    session_start();
    require './database.php';

    $login = $_POST['login'] ?? '';
    $password = md5($_POST['password']) ?? '';

    $sql = "SELECT * FROM utilisateur WHERE login = '$login' AND mot_passe = '$password'";
    
    try{
        $user = query($sql)->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $ex){
        echo $ex->getMessage();
    }
    
    if($user){
        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "nom" => $user['nom'],
            "prenom" => $user['prenom'],
            "email" => $user['email']];
        header('Location: /cabinet.php');
    }
    else {
        $_SESSION['message'] = "Mauvais nom d'utilisateur ou mot de passe";
        header('Location: /');
    }
    
?>