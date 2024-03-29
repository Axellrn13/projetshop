<?php
if (!isset($_SESSION['admin'])) {
    // La variable de session n'existe pas
    // On la crée et on lui affecte une valeur par défaut
    $_SESSION['admin'] = false;
}
if (!isset($_SESSION['panier'])) {
    // La variable de session n'existe pas
    // On la crée et on lui affecte une valeur par défaut
    $_SESSION['panier'] = array();
}
if (!isset($_SESSION['statuspanier'])) {
    // La variable de session n'existe pas
    // On la crée et on lui affecte une valeur par défaut
    $_SESSION['statuspanier'] = 0;
}
$nbArticle = 0;
foreach($_SESSION['panier'] as $articlePanier): // calculer le nombre d'article dans le panier
    $nbArticle = $nbArticle + $articlePanier[1]; //
    $_SESSION['nbArticle'] = $nbArticle;
  
  endforeach;
?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php $this->_t = 'Web4Shop'; foreach ($articles as $article): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <a href="accueil&id=<?= $article->id(); ?>"><img class="card-img-top" src="images/<?= $article->image(); ?>"/></a>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <?php if($article->quantity() <= 0 ) { ?>
                                <div class="text-center">
                                    <h5 class="text-muted text-decoration-line-through fw-bolder"><?= $article->name(); ?></h5>
                                </div>
                            <?php } else { ?>
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?= $article->name(); ?></h5>
                                </div>
                            <?php }?>
                            
                            <?= $article->price(); ?>€
                        </div>
                        <?php if($article->quantity() <= 0 ) { ?>
                            <div class="text-center">
                                <span class='text-danger'>Rupture de stock</span>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if($article->quantity() <= 0 ) { ?>
                        <div class="card-footer p-4 pt-0 border-top-0">
                            <div class="text-center"><a class="btn disabled btn-outline-dark mt-auto" href="">Ajouter au panier</a></div>
                        </div>
                    <?php } else { ?>
                        <div class="card-footer p-4 pt-0 border-top-0">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="accueil&cartArticleId=<?= $article->id(); ?>">Ajouter au panier</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>