<?php $this->_t = 'Vos commandes';
foreach ($orders as $order) { ?>

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
                <p><?= $order->date()?></p>
              </div>
              <div class="col mb-3">
                <p class="small text-muted mb-1">Commande n°</p>
                <p><?= $order->id()?></p>
              </div>
            </div>

            <div class="mx-n5 px-5 py-4" style="background-color: #f2f2f2;">
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p>BEATS Solo 3 Wireless Headphones</p>
                </div>
                <div class="col-md-4 col-lg-3">
                  <p>£299.99</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-lg-9">
                  <p class="mb-0">Shipping</p>
                </div>
                <div class="col-md-4 col-lg-3">
                  <p class="mb-0">£33.00</p>
                </div>
              </div>
            </div>

            <div class="row my-4">
              <div class="col-md-4 offset-md-8 col-lg-5 offset-lg-9">
                <p class="lead fw-bold mb-0" style="color: #212529;">Total : <?= $order->total()?> €</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }?>