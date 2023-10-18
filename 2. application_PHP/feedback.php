<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: /');
}

require './database.php';


$_POST = filter_input_array(INPUT_POST,['note' => FILTER_SANITIZE_NUMBER_INT,
                                        'commentaires' => FILTER_SANITIZE_SPECIAL_CHARS]);

$note = $_POST['note'] ?? '';
$commentaires = $_POST['commentaires'] ?? '';
$objet_id = $_GET['objet_id'];
$utilisateur_a_id = $_SESSION['user']['id'];

$timezone = new DateTimeZone('America/Montreal');
$date_évaluation = new DateTime('now', $timezone);


try{
    $sql = "SELECT utilisateur_v_id FROM objet_proposé WHERE id=$objet_id";
    $stmt = query($sql);
    $objet = $stmt->fetch(PDO::FETCH_ASSOC); 
    $utilisateur_v_id = $objet['utilisateur_v_id'];
  }
  catch(PDOException $ex){
    echo $ex->getMessage();
  }

try{
  Database::insertCommentaire($utilisateur_v_id, $utilisateur_a_id, $note, $commentaires);
}catch (PDOException $ex){
  echo $ex->getMessage();
}

header('Location: /objetsAcheté.php');
?>