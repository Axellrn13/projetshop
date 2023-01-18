<?php
$this->_t = 'Mode de paiement';
?>

<div class="row">
    <div class="col-lg-6 mx-auto mt-4">
        <div class="card">
            <div class="card-header">
                <div class="bg-white shadow-sm pl-2 pr-2">
                    <!-- Credit card form tabs -->
                    <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#paypal" class="nav-link active"> <i
                                    class="fab fa-paypal mr-2"></i> Paypal </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#net-banking" class="nav-link"></i>Chèque</a>
                        </li>
                    </ul>
                </div>
                <!-- End -->
                <!-- Credit card form content -->
                <div class="tab-content">
                    <!-- credit card info-->
                    <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade show active pt-3">
                        <h6 class="pb-2">Passer au paiement :</h6>
                        <div class="d-inline-flex">
                            <div class="p-2">
                                <p>
                                    <a href="cart&payment=paypal"><button onclick="openPopup()" type="button"
                                            class="btn btn-primary"><i class="fab fa-paypal"></i> Se connecter à
                                            Paypal</button></a>
                                </p>
                            </div>
                            <script>
                                function openPopup() {
                                    window.open("https://www.paypal.com/signin", "Nom de la fenêtre", "height=500,width=500");
                                }
                                function openPopup2() {
                                    window.open("cart&invoice", "Facture", "height=500,width=500");
                                }
                            </script>

                        </div>
                        <p class="text-muted">
                            Remarque : En cliquant sur le bouton, vous serez redirigé sur la page Paypal pour passer au
                            paiement.
                        </p>
                    </div>
                    <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <h6 class="pb-2">Passer au paiement :</h6>
                        <div class="form-group ">
                            <div class="d-inline-flex">
                                <div class="p-2">
                                    <p>
                                        <a href="cart&payment=cheque"><button onclick="openPopup2()" type="button" class="btn btn-primary">Télécharger la
                                                facture</button>
                                        </a>
                                    </p>
                                </div>
                                <div class="p-2">
                                    <p>
                                        <a href="cart&payment=cheque"><button type="button" class="btn btn-primary">Valider
                                                cette
                                                méthode de paiement</button></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted">
                            Remarque : En cliquant sur la facture, vous choisissez de payer par chèque. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>