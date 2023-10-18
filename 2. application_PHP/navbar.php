<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?php if(isset($_SESSION['user'])) :?>
            <a class="navbar-brand mx-4" href="./cabinet.php">Liste des objets</a>
          <?php else :?>
            <a class="navbar-brand mx-4" href="index.php">Enchères</a>
          <?php endif?>

          <?php if(isset($_SESSION['user'])) :?>
            <a class="navbar-brand mx-4" href="objetsAcheté.php">Objets acquis</a>
          <?php endif?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION['user'])) :?>
                  <li class="nav-item active">
                    <a class="navbar-brand mx-4" href="new_objet.php">Ajouter un objet </a>
                  </li>
                <?php endif?>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li> -->
              </ul>
              <!-- <form class="form-inline my-2 my-lg-0 d-flex flex-row"> -->
                <?php if(isset($_SESSION['user'])) :?>

                  <span>Bonjour <?=$_SESSION['user']['prenom']?>!</span>

                <?php endif?>
                 <!-- <input  type="search" placeholder="Recherche" aria-label="Recherche"> --> 
                <a class="btn btn-outline-success my-2 my-sm-1 mx-2" href="logout.php">Log out</a>

                <!-- </form> -->
            </div>
        </nav>
    </div>
</header>
