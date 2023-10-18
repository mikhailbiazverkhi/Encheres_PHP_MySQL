<?php
    session_start();
    require './user.php';

    $_POST = filter_input_array(INPUT_POST,['nom' => FILTER_SANITIZE_SPECIAL_CHARS,
                                            'prenom' => FILTER_SANITIZE_SPECIAL_CHARS,
                                            'courriel' => FILTER_SANITIZE_EMAIL,
                                            'login' => FILTER_SANITIZE_EMAIL,
                                            'password' => FILTER_SANITIZE_SPECIAL_CHARS,
                                            'password_confirmation' => FILTER_SANITIZE_SPECIAL_CHARS]);

    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $courriel = $_POST['courriel'] ?? '';
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirmation = $_POST['password_confirmation'] ?? '';

    if (empty($nom) || empty($prenom) || empty($courriel) || empty($login) || empty($password) || empty($password_confirmation)) {
        header('Location: /register.php');
    }
    elseif (!Database::estLoginUnique($login)) {
        $_SESSION['message1'] = "Login n'est pas unique";
        header('Location: /register.php');
    } 

    elseif ($password !== $password_confirmation){
        $_SESSION['message2'] = 'Les mots de passe ne sont pas identiques';
        header('Location: /register.php');
    } 

    else {

        $user = new User();
        $user->nom = $nom;
        $user->prenom = $prenom;
        $user->courriel = $courriel;
        $user->login = $login;
        $user->password = md5($password);
        $user->save();
        header('Location: /');
    }  
?>