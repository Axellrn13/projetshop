<?php 

if (isset($_POST['submit'])) {
    
}

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
                            <h5 class="fw-bolder"><?= $article->name(); ?></h5>
                            <?= $article->price(); ?>€
                        </div>
                        <?php if($article->quantity() <= 0 ) { ?>
                            <div class="text-center">
                                <span class='text-muted text-decoration-line-through'>Rupture de stock</span>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if($article->quantity() <= 0 ) { ?>
                        <div class="card-footer p-4 pt-0 border-top-0">
                            <div class="text-center"><a class="btn disabled btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                        </div>
                    <?php } else { ?>
                        <div class="card-footer p-4 pt-0 border-top-0">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Ajouter au panier</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>