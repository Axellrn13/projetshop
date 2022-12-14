<?php $this->_t = $articles[0]->name(); ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="images/<?= $articles[0]->image(); ?>"
                    alt="..." /></div>
            <div class="col-md-6">
                <?php //<div class="small mb-1">Catégorie: <?= $articles[0]->cat_id(); </div>?>
                    <h1 class="display-5 fw-bolder"><?= $articles[0]->name(); ?>
                </h1>
                <div class="fs-5 mb-5 d-flex flex-row">
                    <span>
                        <?= $articles[0]->price(); ?>€
                    </span>
                </div>
                <?php

                $rupture = false;
                if ($articles[0]->quantity() > 0) {
                    echo "<div class='fs-5 mb-5 d-flex flex-row'>";
                    echo "<span>Quantité restante : " . $articles[0]->quantity() . "</span>";
                    echo "</div>";
                } else {
                    echo "<div class='fs-5 mb-5 d-flex flex-row'>";
                    echo "<span class='text-danger'>Rupture de stock</span>";
                    echo "</div>";
                    $rupture = true;
                }
                ?>
                <p class="lead">
                    <?= $articles[0]->description(); ?>
                </p>

                <div class="d-flex">
                    <?php if (!$rupture) { ?>
                        <input class="form-control text-center me-3 disabled" id="inputQuantity" onkeypress="return false" min="0" max="<?= $articles[0]->quantity(); ?>" type="number" value="1"
                        style="max-width: 4rem" />
                    <?php } ?>
                    <button class="btn btn-outline-dark flex-shrink-0 <?php if ($rupture) echo "disabled" ?>" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Ajouter au panier
                    </button>
                </div>
            </div>
        </div>     
    </div>
</section>


<section class="py-5 text-center">
<h1 class="text-center display-5">Avis</h1>
<div class="container mt-5 mb-5">
    <div class="row g-2 justify-content-center">
        <?php foreach ($reviews as $review): ?>
        <div class="col-md-4">
            <div class="card p-3 text-center px-4">
                <div class="user-image">
                    <img src="images/<?= $review->photo_user(); ?>" class="rounded-circle" width="80">
                </div>
                <div class="user-content">
                    <h5 class="mb-0"><?= $review->name(); ?></h5>
                    <span><?= $review->title(); ?></span>
                    <p><?= $review->description(); ?></p>
                </div>
                <div class="ratings">
                <?php 
                $starsnb = $review->stars();
                if ($starsnb == 5) {
                    for ($i=0; $i < $starsnb; $i++) { ?>
                    <i><img src="images/review_star.png" class="rounded-circle" width="20"></i>
                <?php }
                }
                else {
                    $starsnbmissing = 5 - $starsnb;
                    for ($i=0; $i < $starsnb; $i++) { ?>
                        <i><img src="images/review_star.png" class="rounded-circle" width="20"></i>
                    <?php }
                    for ($i=0; $i < $starsnbmissing; $i++) { ?>
                        <i><img src="images/review_gray.png" class="rounded-circle" width="20"></i>
                <?php }
                }
                ?>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</section>