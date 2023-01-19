<?php $this->_t = 'Vos commandes';
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

foreach ($orders as $order) {
  $payment_type = $order->payment_type();
?>

  <section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-8 col-xl-6">
          <div class="card border-top border-bottom border-3" style="border-color: #212529 !important;">
            <div class="card-body p-5">

              <p class="lead fw-bold mb-5" style="color: #212529;">Détails de votre commande</p>

              <div class="row">
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Date</p>
                  <p><?= $order->date() ?></p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Commande n°</p>
                  <p><?= $order->id() ?></p>
                </div>
                <div class="col mb-3">
                  <p class="small text-muted mb-1">Paiement par</p>
                  <p><?= ucfirst($order->payment_type()) ?></p>
                </div>
              </div>

              <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
                <?php foreach ($ordersitems as $orderitem) :
                  if ($orderitem->order_id() == $order->id()) { ?>
                    <div class="row">
                      <div class="col-md-8 col-lg-9">
                        <p class="mb-0"><?php foreach ($articles as $article) {
                                          if ($article->id() == $orderitem->product_id()) {
                                            echo $orderitem->quantity() . " x " . $article->name();
                                          }
                                        } ?>
                        </p>
                      </div>
                      <div class="col-md-4 col-lg-3">
                        <p class="mb-0"><?php foreach ($articles as $article) {
                                          if ($article->id() == $orderitem->product_id()) {
                                            echo $orderitem->quantity() * $article->price() . "€";
                                          }
                                        } ?></p>
                      </div>
                    </div>
                <?php }
                endforeach; ?>
              </div>


              <div class="row my-4 ">
                <?php if($payment_type == 'cheque'){ ?>
                <div class="col mt-4">
                  <p class="lead fw-bold mb-0" style="color: #212529;">
                  <?php $id = $order->id();?>
                    <a href="<?php echo "account&id=".$id; ?>"><button name="submit" type="submit" class="btn btn-primary ">
                      Accéder à la facture
                    </button></a>
                  </p>
                </div>
                <?php } ?>
                <div class="col-md-4 offset-md-8 col-lg-5 offset-lg-9">
                  <p class="lead fw-bold mb-0" style="color: #212529;">Total : <?= $order->total() ?> €</p>
                </div>
              </div>
              <div class="progress">
                <?php if ($order->status() == 1) { ?>
                  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Entrez votre adresse</div>
                <?php } elseif ($order->status() == 2) { ?>
                  <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Choisir mode de paiement</div>
                <?php } elseif ($order->status() == 10) { ?>
                  <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Commande envoyé<em></em></div>
                  <?php } elseif ($order->status() == -1) { ?>
                  <div class="progress-bar" role="progressbar" style="width: 100%; background-color:red;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Commande annulé<em></em></div>
                <?php } else { ?>
                  <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Préparation de votre commande</div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
<?php } ?>