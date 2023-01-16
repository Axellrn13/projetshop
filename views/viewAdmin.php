<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php $this->_t = 'Web4Shop'; foreach ($articles as $article): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <a href="admin_articles&id=<?= $article->id(); ?>"><img class="card-img-top" src="images/<?= $article->image(); ?>"/></a>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder"><?= $article->name(); ?></h5>
                            <?= $article->price(); ?>€
                        </div>
                        <form method="POST">
                            <div class="form-group">
                                <label for="quantity">Quantité</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?= $article->quantity(); ?>">
                            </div>
                            <div class="form-group text-center mt-4 ">
                                <div class="btn-group" role="group">
                                    <button type="submit" name="<?= $article->id(); ?>"class="btn btn-dark">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>