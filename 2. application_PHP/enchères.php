<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header('Location: /');
  }

  require './header.php';
  require './navbar.php';
  require './database.php';

  if($_GET['objet_id']){
    $id = $_GET['objet_id'];
    $_SESSION['objet_id'] = $_GET['objet_id'];
  } else {
   $id = $_SESSION['objet_id'];
  }

  try{
    $sql = "SELECT * FROM objet_proposé WHERE id=$id";
    $stmt = query($sql);
    $objet = $stmt->fetch(PDO::FETCH_ASSOC);  
  }
  catch(PDOException $ex){
    echo $ex->getMessage();
  }

  $utilisateur_a_id = $_SESSION['user']['id'];

  try{
    $prix_actuel = Database::maxPrix_Objet_proposé($id);
  }catch (PDOException $ex){
    echo $ex->getMessage();
  }

  if(isset($_POST['confirmer'])){
    $_POST = filter_input_array(INPUT_POST,['prix_proposé' => FILTER_SANITIZE_NUMBER_FLOAT]);
    $prix_proposé = $_POST['prix_proposé'] ?? '';

  if(!isset($prix_actuel))
    $prix_actuel = $objet['prix_initial'];



  function estDateExpired($date_fin_enchères){
    $timezone = new DateTimeZone('America/Montreal');
    $dateExpiration = new DateTime($date_fin_enchères, $timezone);
    $dateActuelle = new DateTime('now', $timezone);   
 
    if($dateExpiration > $dateActuelle)
      return false;

    try{
      Database::statutObjetVenduUpdate();
    }catch (PDOException $ex){
      echo $ex->getMessage();
    } 
    return true;
  } 



  if(!estDateExpired($objet['fin_enchères'])){
    if($prix_proposé > $prix_actuel){

      try{
        Database::insertPrixProposé($utilisateur_a_id, $id, $prix_proposé);
      }catch (PDOException $ex){
        echo $ex->getMessage();
      }

      try{
        $prix_actuel = Database::maxPrix_Objet_proposé($id);
      }catch (PDOException $ex){
        echo $ex->getMessage();
      }

    } else {
      $_SESSION['message'] = "Le prix de l'offre doit être supérieur au prix actuel";
    }    
  } else {
    $_SESSION['dateExpiration'] = "La date de fin de l'enchère";
  }
}
?>

<main>
    <div class="container my-3">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-7">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h3 class="text-uppercase text-center mb-5">Enchérir sur l'objet</h3>
                  
                  <form action="/enchères.php?objet_id=<?=$id?>" method="post">
                    
                    <div class="form-outline mb-3">
                      <input type="text" id="prix_initial" name="prix_initial" class="form-control form-control-lg" value="<?=$objet['prix_initial']?>" disabled>
                      <label class="form-label" for="prix_initial" style="margin-left: 0px;">Prix initial</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 71.2px;"></div><div class="form-notch-trailing"></div></div></div>
                    
                    <?php if(isset($prix_actuel) && $prix_actuel !== $objet['prix_initial']) :?>
                    <div class="form-outline mb-3">
                      <input type="text" id="prix_actuel" name="prix_actuel" class="form-control form-control-lg" value="<?=$prix_actuel?>" disabled>
                      <label class="form-label" for="prix_actuel" style="margin-left: 0px;">Prix actuel</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 136px;"></div><div class="form-notch-trailing"></div></div></div>
                    <?php endif?>

                    <div class="form-outline mb-3">
                      <input type="text" id="prix_proposé" name="prix_proposé" class="form-control form-control-lg">
                      <label class="form-label" for="prix_proposé" style="margin-left: 0px;">Votre Prix</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 136px;"></div><div class="form-notch-trailing"></div></div></div>

                    <?php 
                      if(isset($_SESSION['message']))
                        echo '<p class="d-flex justify-content-center" style="color: red">'.$_SESSION['message'].'</p>';
                        unset($_SESSION['message']);
                    ?>
                    <?php 
                      if(isset($_SESSION['dateExpiration']))
                        echo '<p class="d-flex justify-content-center" style="color: red">'.$_SESSION['dateExpiration'].'</p>';
                        unset($_SESSION['dateExpiration']);
                    ?>
                    <div class="d-flex justify-content-around">
                      <button type="submit" name="confirmer" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Confirmer</button>
                      <a class="btn btn-secondary btn-block btn-lg gradient-custom-4 text-body" href="./object.php?objet_id=<?=$id?>">Retourner</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php require './footer.php'?>
</body>
</html>

