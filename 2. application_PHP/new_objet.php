<?php
  session_start();
    if(!isset($_SESSION['user'])){
      header('Location: /');
    }

  require './header.php';
  require './navbar.php';
  require './database.php';

  try{
    $stmt = Database::selectAllCatégories();
    $catégories = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }catch (PDOException $ex){
    echo $ex->getMessage();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enchères</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <?php require './header.php'?>

  <main>
    <div class="container my-3">
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-7">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h3 class="text-uppercase text-center mb-3">Nouvel objet</h3>
                  
                  <form action="upload_objet.php" method="post" enctype="multipart/form-data">
                    
                    <div class="form-outline mb-3">
                      <input type="text" id="nom" name="nom" class="form-control form-control-lg" required>
                      <label class="form-label" for="nom" style="margin-left: 0px;">Nom de votre objet</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 71.2px;"></div><div class="form-notch-trailing"></div></div></div>

                    <div class="form-outline mb-4">
                      <select id="catégorie" name="catégorie" class="form-select form-select-lg" aria-label="Default select example" required>
                        <option selected value=""> -- Choisissez une catégorie --</option>
                          <?php foreach($catégories as $catégorie) :?>
                            <option value="<?=$catégorie['id']?>"><?=$catégorie['nom']?></option>
                          <?php endforeach;?>
                      </select>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 71.2px;"></div><div class="form-notch-trailing"></div></div></div>
                    
                    <div class="form-outline mb-3">
                      <input type="text" id="description" name="description" class="form-control form-control-lg" required>
                      <label class="form-label" for="description" style="margin-left: 0px;">Description</label>
                    </div>

                    <div class="form-outline mb-3">
                      <input type="text" id="prix_initial" name="prix_initial" class="form-control form-control-lg" required>
                      <label class="form-label" for="prix_initial" style="margin-left: 0px;">Prix initial</label>
                    </div>

                    <div class="form-outline mb-3">
                      <input type="file" id="photo" name="photo" class="form-control form-control-lg" accept="image/*" required>
                      <!-- accept="image/png, image/gif, image/jpeg" required> -->
                      <label class="form-label" for="photo" style="margin-left: 0px;">Image de l'objet</label>
                    <div class="form-notch"><div class="form-notch-leading" style="width: 9px;"></div><div class="form-notch-middle" style="width: 69.6px;"></div><div class="form-notch-trailing"></div></div></div>
                    
                    <div class="form-outline mb-3">
                      <input type="datetime-local" id="fin_date" name="fin_date" class="form-control form-control-lg" required>
                      <label class="form-label" for="fin_date" style="margin-left: 0px;">La date et l'heure de fin des enchères</label>
                    </div>
                    <div class="d-flex justify-content-around">
                      <?php if(isset($_SESSION['ajouter_plus'])) :?>
                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Ajouter plus</button>
                      <?php else :?>
                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Ajouter</button>
                      <?php endif;
                        unset($_SESSION['ajouter_plus']);
                      ?>
                      <a class="btn btn-secondary btn-block btn-lg gradient-custom-4 text-body" href="./cabinet.php">Retourner</a>
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