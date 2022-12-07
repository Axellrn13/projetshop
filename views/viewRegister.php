<?php $this->_t = 'Créer un compte'; ?>
<?php
require('config.php');
if (isset($_POST['nom'], $_POST['prenom'],$_POST['codepost'], $_POST['tel'], $_POST['mdp']) AND (!empty($_POST['mdp']))){
  // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
  $prenom = stripslashes($_POST['prenom']);
  $prenom = mysqli_real_escape_string($conn, $prenom); 
  // récupérer l'nom et supprimer les antislashes ajoutés par le formulaire
  $nom = stripslashes($_POST['nom']);
  $nom = mysqli_real_escape_string($conn, $nom);
  // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
  $mdp = stripslashes($_POST['mdp']);
  $mdp = mysqli_real_escape_string($conn, $mdp);
  // récupérer le code postal et supprimer les antislashes ajoutés par le formulaire
  $codepost = stripslashes($_POST['codepost']);
  $codepost = mysqli_real_escape_string($conn, $codepost);
  // récupérer le téléphone et supprimer les antislashes ajoutés par le formulaire
  $tel = stripslashes($_POST['tel']);
  $tel = mysqli_real_escape_string($conn, $tel);
  
  //requéte SQL + mot de passe crypté
    $queryLogins = "INSERT into `logins` ( username, password)
              VALUES ('$username', '".hash('sha256', $mdp)."')";
    $queryCustomers = "INSERT into `customers` (forname, surname, postcode, tel)
    VALUES ('$nom', '$prenom','$codepost','$tel', '".hash('sha256', $mdp)."')";
  // Exécuter la requête sur la base de données
    $resL = mysqli_query($conn, $queryLogins);
    $resC = mysqli_query($conn, $queryCustomers);
    if($res&&$resC){
       echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
       </div>";
    }
}else{
?>

<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-3 bg-image"></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong">
    <div class="card bg-dark text-white card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-7">
          <h2 class="fw-bold mb-5 text-uppercase">Créer un compte</h2>
          <form action="accueil" method="post" autocomplete="off">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input autocomplete="off" name="username" type="text" id="form3Example1" class="form-control" />
                  <label class="form-label"  for="form3Example1">Pseudo</label>
                </div>
              </div>
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input autocomplete="off" name="nom" type="text" id="form3Example1" class="form-control" />
                  <label class="form-label"  for="form3Example1">Nom</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" name="prenom" id="form3Example2" class="form-control" />
                  <label class="form-label"  for="form3Example2">Prénom</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input autocomplete="off"  name="codepost" type="text" id="form3Example1" class="form-control" />
                  <label class="form-label"  for="form3Example1">Code postal</label>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input autocomplete="off" name="tel" type="text" id="form3Example2" class="form-control" />
                  <label class="form-label"  for="form3Example2">N°Téléphone</label>
                </div>
              </div>
            </div>


            <!-- Email input -->
            <div class="form-outline mb-4">
              <input autocomplete="off" name="mail" type="email" id="form3Example3" class="form-control" />
              <label class="form-label"  for="form3Example3">Adresse mail</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input autocomplete="off" name="mdp"type="password" id="form3Example4" class="form-control" />
              <label class="form-label"  for="form3Example4">Mot de passe</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-outline-light btn-lg px-5">
                Créer un compte
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>  <?php } ?>
