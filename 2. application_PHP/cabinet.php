
<?php
  session_start();
  if(!isset($_SESSION['user'])){
    header('Location: /');
  }

  require './header.php';
  require './navbar.php';
  require './database.php';

  try{
    Database::statutObjetVenduUpdate();
  }catch(PDOException $ex){
    echo $ex->getMessage();
}
?>

  <main>
    <div class="container my-5">
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Photo</th>
                <th scope="col">Prix actuel</th>
                <th scope="col">Temps restant</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $i = 0;
                try{
                    $sql = "SELECT * FROM objet_proposé WHERE estVendu = 0 ";
                    $stmt = query($sql);
                    $objets = $stmt->fetchAll(PDO::FETCH_ASSOC);               
                    foreach($objets as $objet):
            ?>
            
              <tr class="objetRow" onclick="redirectObjet(<?=$objet['id']?>)">
                <!-- <th scope="row"><?=$objet['id']?></th> -->
                <th scope="row"><?=++$i?></th>
                <td><?=$objet['nom']?></td>
                <td><img src="<?=$objet['chemin_photo']?>" alt="" width="200"></td>
                <?php
                  $prix_actuel = Database::maxPrix_Objet_proposé($objet['id']);
                  if(isset($prix_actuel)) :
                ?>
                  <td><?=$prix_actuel?></td>
                <?php else :?>
                  <td><?=$objet['prix_initial']?></td>
                <?php endif?>
                <td>
                    <?php
                      $timezone = new DateTimeZone('America/Montreal');
                        $dateExpiration = new DateTime($objet['fin_enchères'], $timezone);
                        $dateActuelle = new DateTime('now', $timezone);                    
                        $diff = $dateExpiration->diff($dateActuelle);
                        echo $diff->format('%d j %H h %i m %s s');
                    ?>                   
                </td>
              </tr>
            
            <?php
                    endforeach;
                }
                catch(PDOException $ex){
                    echo $ex->getMessage();
                }             
            ?>      
            </tbody>
        </table>
    </div>
  </main>

  <?php require './footer.php'?>
</body>
</html>