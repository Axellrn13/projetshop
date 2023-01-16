
<section class="py-5">
    <div class="container px-4 px-lg-2 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
<table class="table">
    <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Id du client</th>
            <th scope="col">Nom</th>
            <th     scope="col">Prénom</th>
            <th class="text-center"scope="col">Date</th>
            <th class="text-center"scope="col">Détails de la commande</th>
            <th class="text-center"scope="col">Total</th>
            <th scope="col">Statut de la commande</th>
            <th class="text-center"scope="col">Valider la commande</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <th scope="row"><?= $order->id() ?></th>
                <td><?= $order->customer_id() ?></td>
                <td><?php foreach ($customers as $customer) {
                        if ($customer->id() == $order->customer_id()) {
                            echo $customer->surname();
                        }
                    } ?></td>
                <td><?php foreach ($customers as $customer) {
                        if ($customer->id() == $order->customer_id()) {
                            echo $customer->forname();
                        }
                    } ?></td>
                <td><?= $order->date() ?></td>
                <td><div class="mx-n5 px-5 py-4">
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
              </div></td>
              <td><?= $order->total()."€" ?></td>
                <td><?php

                    if ($order->status() == 2) {
                        echo "En attente du choix de paiement";
                    } elseif ($order->status() == 3) {
                        echo "En attente de validation";
                    } else {
                        echo "Commande validé";
                    }
                    ?></td>
                <?php if ($order->status() == 3) { ?>
                    <td><button name="submit" type="submit" class="btn btn-success ">
                            Valider
                        </button></td>
                <?php } else { ?>
                    <td><button name="submit" type="submit" class="btn btn-danger">
                            Annuler
                        </button></td>
                <?php } ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
    </div>
</section>