<?php $this->_t = 'Se connecter'; ?>

<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Se connecter</h2>
              <form method="POST" action="accueil">
                <div class="mb-3">
                  <input type="text" name="username" class="form-control" autocomplete="off" id="username">
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
              <p class="mb-0">Vous n'avez pas de compte? <a href="#!" class="text-white-50 fw-bold">Créer un compte</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>