<?php
$this->_t = 'Mes infos';

if (isset($_POST['submit'])) {

    $_SESSION['username'] = $_POST['username'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['prenom'] = $_POST['prenom'];
    $_SESSION['codepost'] = $_POST['codepost'];
    $_SESSION['tel'] = $_POST['tel'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['adresse'] = $_POST['adresse'];
    $_SESSION['ville'] = $_POST['ville'];
    $_SESSION['pays'] = $_POST['pays'];
    header("Location: account&update");
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
                    <h2 class="fw-bold mb-5 text-uppercase">Mes infos</h2>
                    <form action="" method="POST" autocomplete="off">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="form-outline mb-4">
                            <input autocomplete="off" name="username" type="text" class="form-control"
                                value="<?= $logins[0]->username(); ?>" readonly></input>
                            <label class="form-label" for="form3Example3">Pseudo</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input autocomplete="off" name="nom" type="text" id="form3Example1"
                                        class="form-control" value="<?= $customers[0]->forname(); ?>" />
                                    <label class="form-label" for="form3Example1">Nom</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="prenom" id="form3Example2" class="form-control"
                                        value="<?= $customers[0]->surname(); ?>" />
                                    <label class="form-label" for="form3Example2">Prénom</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <input autocomplete="off" name="adresse" type="text" class="form-control"
                                value="<?= $customers[0]->add1(); ?>"/>
                            <label class="form-label" for="form3Example3">Adresse</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input autocomplete="off" name="ville" type="text" id="form3Example1"
                                        class="form-control" value="<?= $customers[0]->add3(); ?>" />
                                    <label class="form-label" for="form3Example1">Ville</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" name="pays" id="form3Example2" class="form-control"
                                        value="<?= $customers[0]->add2(); ?>" />
                                    <label class="form-label" for="form3Example2">Pays</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input autocomplete="off" name="codepost" type="text" id="form3Example1"
                                        class="form-control" value="<?= $customers[0]->postcode(); ?>" />
                                    <label class="form-label" for="form3Example1">Code postal</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input autocomplete="off" name="tel" type="text" id="form3Example2"
                                        class="form-control" value="<?= $customers[0]->phone(); ?>" />
                                    <label class="form-label" for="form3Example2">N°Téléphone</label>
                                </div>
                            </div>
                        </div>


                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input autocomplete="off" name="mail" type="email" id="form3Example3" class="form-control"
                                value="<?= $customers[0]->email(); ?>" />
                            <label class="form-label" for="form3Example3">Adresse mail</label>
                        </div>

                        <!-- Submit button -->
                        <button name="submit" type="submit" class="btn btn-outline-light btn-lg px-5">
                            Modifier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->