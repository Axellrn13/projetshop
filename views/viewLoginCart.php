<?php $this->_t = 'Se connecter';

if (isset($_POST['submit'])) {
  foreach ($admin as $adm):
    if ($adm->username() == $_POST['username2'])
    {
      if ($adm->password() == ($_POST['mdp'])){
        $_SESSION['username'] = $adm->username();
        $_SESSION['id'] = $adm->id();
        $_SESSION['admin'] = true;
        header("Location: accueil");
      }
    }
    endforeach;
  foreach ($logins as $login):
    if ($login->username() == $_POST['username2']) {
      if ($login->password() == md5($_POST['mdp'])) {
        $_SESSION['username'] = $login->username();
        $_SESSION['id'] = $login->id();
        $_SESSION['customer_id'] = $login->customerid();
        foreach ($customers as $customer):
          if ($customer->id() == $_SESSION['customer_id']) {
            $_SESSION['nom'] = $customer->forname();
            $_SESSION['prenom'] = $customer->surname();
          }
        endforeach;
        header("Location: accueil");
      } else { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Mot de passe incorrect !</strong> Veuillez réessayer.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      }
    }
  endforeach;
}
?>


<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
          <h5 class="mb-2">Pour accéder à votre panier, veuillez vous connectez</h2>
            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Se connecter</h2>
              <form method="POST" action="">
                <div class="mb-3">
                  <input type="text" name="username2" class="form-control" autocomplete="off" id="username2">
                  <label for="username" class="form-label">Pseudo</label>
                </div>
                <div class="mb-3">
                  <input type="password" name="mdp" class="form-control" id="exampleInputPassword1">
                  <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                </div>
                <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Se connecter</button>
              </form>
            </div>
            <div>
              <p class="mb-0">Vous n'avez pas de compte? <a href="register" class="text-white-50 fw-bold">Créer un
                  compte</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>