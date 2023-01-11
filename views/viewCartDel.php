<?php
if (isset($_POST['submit'])) {
    if ($_POST['adressecart'] == $customers[0]->add1()) {
        $_SESSION['panierstatus'] = 2;
    } else {
        $_SESSION['codepost'] = $_POST['postcodecart'];
        $_SESSION['tel'] = $_POST['phonecart'];
        $_SESSION['mail'] = $_POST['emailcart'];
        $_SESSION['adresse'] = $_POST['adressecart'];
        $_SESSION['ville'] = $_POST['villecart'];
        $_SESSION['pays'] = $_POST['payscart'];
    }
}

if (isset($_SESSION['customer_id'])) { ?>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="card mb-4 mt-4 ">
                <div class="card-header py-3">
                    <h5 class="mb-0">Entrez l'adresse de livraison</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST" autocomplete="off">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input value="<?= $customers[0]->surname(); ?>" readonly type="text" id="form7Example1"
                                        class="form-control" />
                                    <label class="form-label" for="form7Example1">Prénom</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input value="<?= $customers[0]->forname(); ?>" readonly type="text" id="form7Example2"
                                        class="form-control" />
                                    <label class="form-label" for="form7Example2">Nom</label>
                                </div>
                            </div>
                        </div>

                        <!-- Text input -->
                        <div class="form-outline mb-4">
                            <input value="<?= $customers[0]->add1(); ?>" name="adressecart" type="text" id="form7Example4"
                                class="form-control" />
                            <label class="form-label" for="form7Example4">Adresse</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input value="<?= $customers[0]->postcode(); ?>" name="postcodecart" type="text" id="form7Example4"
                                class="form-control" />
                            <label class="form-label" for="form7Example4">Code postal</label>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input value="<?= $customers[0]->add2(); ?>" name="payscart" type="text"
                                        id="form7Example1" class="form-control" />
                                    <label class="form-label" for="form7Example1">Pays</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input value="<?= $customers[0]->add3(); ?>" name="villecart" type="text"
                                        id="form7Example2" class="form-control" />
                                    <label class="form-label" for="form7Example2">Ville</label>
                                </div>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input value="<?= $customers[0]->email(); ?>" readonly name="emailcart" type="email"
                                id="form7Example5" class="form-control" />
                            <label class="form-label" for="form7Example5">Email</label>
                        </div>

                        <!-- Number input -->
                        <div class="form-outline mb-4">
                            <input value="<?= $customers[0]->phone(); ?>" name="phonecart" type="number" id="form7Example6"
                                class="form-control" />
                            <label class="form-label" for="form7Example6">Téléphone</label>
                        </div>
                        <button name="submit" type="submit" class="btn btn-outline-dark btn-lg px-5">
                            Valider adresse de livraison
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>