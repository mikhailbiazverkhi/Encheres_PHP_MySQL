
<?php
    session_start();
    if(!isset($_SESSION['user'])){
    header('Location: /');
    }

    require './header.php';
    require './navbar.php';
    require './database.php';
    $id = $_GET['objet_id'];
    $_SESSION['objet_id'] = $_GET['objet_id'];

try{
    $sql = "SELECT * FROM objet_proposé o
    JOIN utilisateur u ON o.utilisateur_v_id = u.id 
    JOIN catégorie c ON o.catégorie_id = c.id WHERE o.id=$id";
    $stmt = query($sql);
    $objet = $stmt->fetch(PDO::FETCH_NUM);     
}
catch(PDOException $ex){
    echo $ex->getMessage();
} 
?>
  <main>
    <div class="container my-5">
        <div class="row">
            <div class="col-sm d-flex justify-content-center">
                <div class="card" style="width: 30rem;">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Nom d'objet: <b><?=$objet[2]?></b></li>
                      <li class="list-group-item">Vendeur (pseudo): <a href="vendeur.php?utilisateur_id=<?=$objet[10]?>"><b><?=$objet[16]?></b></a></li>
                      <li class="list-group-item">Prix initial: <b><?=$objet[3]?></b></li>
                      <li class="list-group-item">Prix actuel: <b>
                          <?php
                              $prix_actuel = Database::maxPrix_Objet_proposé($id);
                              if(isset($prix_actuel)) :
                          ?>
                              <?=$prix_actuel?>
                          <?php else :?>
                              <td><?=$objet[3]?></td>
                          <?php endif?></b></li>
                      <li class="list-group-item">Date de mise en vente: <b><?=$objet[4]?></b></li>
                      <li class="list-group-item">Date de fin de l'enchère: <b><?=$objet[5]?></b></li>
                      <li class="list-group-item">Temps restant jusqu'à la fin de l'enchère: <b>
                          <?php $dateExpiration = new DateTime($objet[5]);
                              $dateActuelle = new DateTime();    
                              $diff = $dateExpiration->diff($dateActuelle);
                              echo $diff->format('%d j %H h %i m %s m');
                          ?>
                      </b></li>
                      <li class="list-group-item">Catégorie de l'objet: <b><?=$objet[19]?></b></li>
                      <li class="list-group-item">Description: <b><?=$objet[7]?></b> </li>
                    </ul>
                </div>
            </div>
                        
            <div class="col-sm d-flex justify-content-center">          
                <div class="card" style="width: 30rem;">
                    <img class="card-img-top" src="<?=$objet[8]?>" alt="<?=$objet[2]?>">
                    <div class="card-body">
                      <h5 class="card-title"><?=$objet[2]?></h5>
                    </div>
                </div>             
            </div>
        </div>

        <div class="d-flex justify-content-around mt-5">
          <a class="btn btn-primary" href="./enchères.php?objet_id=<?=$id ?>">Enchérir</a>
          <a class="btn btn-secondary" href="./cabinet.php">Retourner</a>
        </div>
    </div>
  </main>

<?php require './footer.php'?>

</body>
</html>

