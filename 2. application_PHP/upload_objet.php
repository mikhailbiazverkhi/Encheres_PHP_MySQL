<?php
    session_start();
    if(!isset($_SESSION['user'])){
      header('Location: /');
    }

    require './header.php';
    require './navbar.php';
    require './database.php';

    $_POST = filter_input_array(INPUT_POST,['nom' => FILTER_SANITIZE_SPECIAL_CHARS,
                                            'catégorie' => FILTER_SANITIZE_NUMBER_INT,
                                            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
                                            'prix_initial' => FILTER_SANITIZE_NUMBER_FLOAT,
                                            'fin_date' => FILTER_SANITIZE_SPECIAL_CHARS]);

    $nom = $_POST['nom'] ?? '';
    $catégorie = $_POST['catégorie'] ?? '';
    $description = $_POST['description'] ?? '';
    $prix_initial = $_POST['prix_initial'] ?? '';
    $fin_date = $_POST['fin_date'] ?? '';

    $utilisateur_v_id = $_SESSION['user']['id'];

    $chemin_photo = 'uploads/'. time() . '_' . $_FILES['photo']['name'];

    if(!move_uploaded_file($_FILES['photo']['tmp_name'], './' . $chemin_photo)){
        $_SESSION['message'] = 'L\'image téléchargée avec erreur';
        header('Location: /new_objet.php');
    } else {
        try{
            Database::insertObjet($utilisateur_v_id, $nom, $catégorie, $description, $prix_initial, $fin_date, $chemin_photo);
        }catch (PDOException $ex){
            echo $ex->getMessage();
        }
        $_SESSION['ajouter_plus'] = true;
        header('Location: /new_objet.php');
    }
?>