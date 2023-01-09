<?php 
$this->_t='Panier';
if (isset($_GET['remove'])) {
  $index = $_GET['remove']; // index de l'élément à retirer
  array_splice($_SESSION['panier'], $index, 1);
}
$nbArticle = 0;
foreach($_SESSION['panier'] as $articlePanier): 
  $nbArticle = $nbArticle + $articlePanier[1];
  $_SESSION['nbArticle'] = $nbArticle;

endforeach;
print_r($_SESSION['panier']);
?>
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Panier</h1>
                    <h6 class="mb-0 text-muted"><?= $nbArticle; ?> articles</h6>
                  </div>
                  <hr class="my-4">
                  
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                  <?php $count = -1; foreach($_SESSION['panier'] as $articlePanier): 
                    $count += 1; ?>
                    <div class="col-md-2 col-lg-2 col-xl-2 mb-3">  
                      <img
                      src="images/<?php foreach ($articles as $article) : 
                          if($article->id() == $articlePanier[0]){
                            echo $article->image();
                          }
                          endforeach;?>"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted"><?php foreach ($articles as $article) : 
                          if($article->id() == $articlePanier[0]){
                            echo $article->name();
                          }
                          endforeach;?></h6>
                      <h6 class="text-black mb-0"><?php foreach ($articles as $article) : 
                          if($article->id() == $articlePanier[0]){
                            $string = $article->description();
                            $max_length = 60;
                            if (strlen($string) > $max_length) {
                              $string = substr($string, 0, $max_length) . "...";
                            }
                            echo $string;
                          }
                          endforeach;?></h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                        <i class="fas fa-minus"></i>
                      </button>

                      <input id="form1" min="0" name="quantity" value="<?= $articlePanier[1] ?>" type="number"
                        class="form-control form-control-sm" />

                      <button class="btn btn-link px-2"
                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0"><?php foreach ($articles as $article) : 
                          if($article->id() == $articlePanier[0]){
                            $prix = $articlePanier[1] * $article->price();
                            echo $prix."€";
                          }
                          endforeach;?></h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="cart&remove=<?=  $count; ?>" class="text-muted"><i class="fas fa-times"></i></a>
                    </div>
                    <?php endforeach;?>
                  </div>

                  <hr class="my-4">
                  <div class="pt-5">
                    <h6 class="mb-0"><a href="accueil" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Continuer vos achats</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Récapitulatif</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase"><?= $nbArticle; ?> Articles </h5>
                    <h5>€ 132.00</h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Mode de paiment</h5>

                  <div class="mb-4 pb-2">
                    <select class="select">
                      <option value="1">Visa</option>
                      <option value="2">Paypal</option>
                      <option value="3">Cheque</option>
             
                    </select>
                  </div>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Prix total</h5>
                    <h5>€ 137.00</h5>
                  </div>

                  <button type="button" class="btn btn-dark btn-block btn-lg"
                    data-mdb-ripple-color="dark">Register</button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
