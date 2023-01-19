<?php
if (isset($_POST['submit'])) {
    $_SESSION['qtyToModify'] = $_POST['qty'];
    $_SESSION['idToModify'] = $_POST['id'];
    $_SESSION['descToModify'] = $_POST['description'];
    $_SESSION['priceToModify'] = $_POST['price'];
    header("Location: accueil&modifyqty");
}
if ($_SESSION['admin'] == true) {
    ?>
<section class="py-5">
    <div class="container px-1 px-lg-5 mt-5">
        <addressdiv class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php $this->_t = 'Web4Shop';
            foreach ($articles as $article):
                ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <a href="accueil&id=<?= $article->id(); ?>"><img class="card-img-top"
                                src="images/<?= $article->image(); ?>" /></a>
                        <div class="card-body p-4 text-center">
                            <div class="text-center">
                                <h5 class="fw-bolder">
                                    <?= $article->name(); ?>
                                </h5>
                                <?= $article->price(); ?>€
                            </div>
                            <form action="" method="post" autocomplete="off">
                                <div class="form-group align-items-center mt-4">
                                    <label for="quantity">ID de l'article</label>
                                    <input type="number" readonly class="form-control" id="id" name="id"
                                        value="<?= $article->id(); ?>">
                                </div>
                                <div class="form-group align-items-center mt-4">
                                    <label for="quantity">Description</label>
                                    <textarea class="form-control" name="description"
                                        rows="2"><?= $article->description(); ?></textarea>
                                </div>
                                <div class="form-group align-items-center mt-4">
                                    <label for="quantity">Prix</label>
                                    <input type="float" class="form-control" name="price" min=0
                                        value="<?= $article->price(); ?>">
                                </div>
                                <div class="form-group align-items-center mt-4">
                                    <label for="quantity">Quantité</label>
                                    <input type="number" class="form-control" id="qty" name="qty" min=0
                                        value="<?= $article->quantity(); ?>">
                                    <div class="form-group text-center mt-4 ">
                                        <button name="submit" type="submit" class="btn btn-dark">Enregistrer</button>
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
<?php } else { ?>


<?php }?>