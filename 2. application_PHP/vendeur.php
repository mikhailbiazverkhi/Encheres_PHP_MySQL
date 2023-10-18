<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: /');
    }
    
    require './header.php';
    require './navbar.php';
    require './database.php';

    $id = $_GET['utilisateur_id'];

try{
    $sql = "SELECT * FROM utilisateur WHERE id=$id";
    $stmt = query($sql);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);     

    $sql1 = "SELECT count(*) FROM objet_proposé WHERE utilisateur_v_id=$id AND estVendu = true";
    $stmt = query($sql1);
    $nombreObjets = $stmt->fetch(PDO::FETCH_ASSOC); 
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
                    <div class="card-header">
                    <h4>Vendeur (pseudo): <b><?=$utilisateur['login']?></b><h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h5>Nom: <b><?=$utilisateur['nom']?></b></h5></li>
                        <li class="list-group-item"><h5>Prenom: <b><?=$utilisateur['prenom']?></b></h5></li>
                        <li class="list-group-item"><h5>Courriel: <b><?=$utilisateur['courriel']?></b></h5></li>
                        <li class="list-group-item"><h5>
                            <!-- date d'adhésion: <?=date_format(new DateTime($utilisateur['date_adhésion']),'Y-m-d')?><br> -->
                            Date d'adhésion: <b><?=(new DateTime($utilisateur['date_adhésion']))->format('Y-m-d')?></b></h5></li>
                        <li class="list-group-item"><h5>Nombre_d'objets vendus: <b><?=$nombreObjets['count(*)']?></b></h5></li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-around mt-5">
                <a class="btn btn-secondary" href="object.php?objet_id=<?=$_SESSION['objet_id']?>">Retourner</a>
            </div>

            <h2 class="my-5">Commentaires</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Login</th>
                        <th scope="col">Date</th>
                        <th scope="col">Note</th>
                        <th scope="col">Commentaire</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    try{
                        $sql = "SELECT * FROM évaluation é
                        JOIN utilisateur u ON é.utilisateur_a_id = u.id
                        WHERE utilisateur_v_id = $id";
                        $stmt = query($sql);
                        $objets = $stmt->fetchAll(PDO::FETCH_ASSOC);  
                    }
                    catch(PDOException $ex){
                        echo $ex->getMessage();
                    }
                    $i=0;
                    foreach($objets as $objet) :
                ?>
                    <tr>
                        <th scope="row"><?=++$i?></th>
                        <td><?=$objet['login']?></td>
                        <td><?=$objet['date_évaluation']?></td>
                        <td><?=$objet['note']?></td>
                        <td><?=$objet['commentaire']?></td>
                    </tr>               
                <?php endforeach;?>  
                </tbody>
            </table>  
        </div>   
    </div>
  </main>
  
<?php require './footer.php'?>

</body>
</html>