<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <title>
        <?= $t ?>
    </title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= URL ?>"><img src="images/Web4ShopHeader.png" width="160px;"
                    class="rounded" alt="" srcset=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accueil&categorie=1">Boissons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accueil&categorie=2">Biscuits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="accueil&categorie=3">Fruits secs</a>
                    </li>
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCategories" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administration
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories">
                                <a class="dropdown-item" href="accueil&order">Gérer les commandes</a>
                                <a class="dropdown-item" href="accueil&admin">Gérer les articles</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if ($_SESSION['admin'] != true) {

                        if (isset($_SESSION['panier']) && isset($_SESSION['nbArticle']) && $_SESSION['panier'] != []) { ?>
                            <li class="nav-item position-relative">
                                <a class="nav-link" href="cart">Panier
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?= $_SESSION['nbArticle']; ?>
                                    </span></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="cart">Panier</a>
                            </li>
                        <?php }
                    } ?>
                    <?php
                    if (isset($_SESSION['username'])) {
                        if ($_SESSION['admin'] != true) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION['username']; ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="account&order">Vos commandes</a></li>
                                    <li><a class="dropdown-item" href="account">Votre compte</a></li>
                                </ul>
                            </li>
                            <?php
                        } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="">Admin</a>
                            </li>
                        <?php }
                    } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login">
                                Se connecter
                            <?php } ?>
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Se déconnecter</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    <?= $description ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
        crossorigin="anonymous"></script>

</body>

<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">© ISIWeb4Shop 2022-2023 Titouan & Axel</p>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Accueil</a></li>
            <li class="nav-item"><a href="https://github.com/Axellrn13/projetshop"
                    class="nav-link px-2 text-muted">Github</a></li>
            <li class="nav-item"><a
                    href="https://www.dropbox.com/home/ISI-WEB%2022-23/ISI-WEB%20TP%20Final%202022-2023?preview=ISIWEB-PHP+Projet+shopping+Bag+2022-2023.pdf"
                    class="nav-link px-2 text-muted">Sujet</a></li>
        </ul>
    </footer>
</div>

</html>