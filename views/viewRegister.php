<?php
$this->_t = 'Créer un compte';

if(isset($_POST['submit']))
{
  $alreadyRegistered = false;
  foreach ($logins as $login):
    if($login->username() == $_POST['username'])
    {
      $alreadyRegistered = true;
    }
  endforeach;
  if (!$alreadyRegistered) {
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['nom'] = $_POST['nom'];
      $_SESSION['prenom'] = $_POST['prenom'];
      $_SESSION['codepost'] = $_POST['codepost'];
      $_SESSION['tel'] = $_POST['tel'];
      $_SESSION['mail'] = $_POST['mail'];
      $_SESSION['mdp'] = md5($_POST['mdp']);
      header("Location: register&creation");
  }
}


?>
<section class="text-center">
  <!-- Background image -->
  <div class="p-3 bg-image"></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong">
    <div class="card bg-dark text-white card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-7">
          <h2 class="fw-bold mb-5 text-uppercase">Créer un compte</h2>
          <form action="" method="POST" autocomplete="off">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="form-outline mb-4">
              <input autocomplete="off" name="username" type="text" class="form-control" />
              <label class="form-label"  for="form3Example3">Pseudo</label>
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
            <button name="submit" type="submit" class="btn btn-outline-light btn-lg px-5">
                Créer un compte
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->