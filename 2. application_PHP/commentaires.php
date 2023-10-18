
<?php
    session_start();
    if(!isset($_SESSION['user'])){
    header('Location: /');
    }

    require './header.php';
    require './navbar.php';
    
    $id = $_GET['objet_id'];

?>
  <main>
    <div class="container my-5">
        <form action="feedback.php/?objet_id=<?=$id?>" method="post">
            <div class="form-group">
            <label for="note"><h4>Votre note <span style="color:red;">*</span></h4></label>
            <input type="number" class="form-control" id="note" name="note" min="0" max= "10" placeholder="Note de 0 à 10" required>
            </div>
            <div class="form-group mt-5">
                <label for="commentaires"><h4>Vos commentaires</h4></label>
                <textarea class="form-control" id="commentaires" name="commentaires" rows="3" ></textarea>
            </div>
            <div class="d-flex justify-content-around mt-5">
                <button type="submit" name="envoyer" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Envoyer</button>
                <a class="btn btn-secondary btn-block btn-lg gradient-custom-4 text-body" href="./objetsAcheté.php">Retourner</a>
            </div>
        </form>
    </div>
  </main>

<?php require './footer.php'?>

</body>
</html>

