
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
                <th scope="col">Fin de l'enchère</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $i = 0;
                try{
                    $sql = "SELECT *, MAX(e.prix_proposé) FROM enchères e  
                    JOIN objet_proposé o ON e.objet_proposé_id = o.id 
                    WHERE o.estVendu = true AND 
                    e.utilisateur_a_id =". $_SESSION['user']['id'].
                    " GROUP BY e.objet_proposé_id";

                    $stmt = query($sql);
                    $objets = $stmt->fetchAll(PDO::FETCH_ASSOC);     
                    //print_r($objets);
                    foreach($objets as $objet):
            ?>
            
              <tr class="objetRow" onclick="redirectCommentaires(<?=$objet['id']?>)">
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
                <td><?=$objet['fin_enchères']?></td>
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