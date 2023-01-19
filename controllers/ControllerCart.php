<?php

require_once('views/View.php');

class ControllerCart
{
    private $_view;
    private $_articleManager;
    private $_loginManager;
    private $_orderManager;
    private $_orderitemsManager;
    private $_customerManager;
    private $_deliveryAdressesManager;
    private $_adminManager;


    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['totalCart'])) { // Dès qu'on clique sur valider le panier, on accède à la vue avec l'adresse de livraison
            $this->ValiderCart();
            $_SESSION['totalCart'] = $_GET['totalCart'];
        } elseif (isset($_GET['adressChecked'])) { // Dès qu'on valide l'adresse de livraison, on passe au choix du mode de paiement
            $_SESSION['statuspanier'] = 2;
            $this->ValiderPayment();
        } elseif (isset($_GET['adressModified'])) { // si le client modifie son adresse, on l'ajoute à delivery_adresses et on passe au choix du mode de paiement
            $_SESSION['statuspanier'] = 2;
            $this->ModifyAdress();
        } elseif (isset($_GET['payment'])) { // le client a choisi son mode de paiement, on le renvoie sur ces commandes
            $_SESSION['statuspanier'] = 3;
            $this->paymentChecked();
            unset($_SESSION['statuspanier']);
            unset($_SESSION['panier']);
        } elseif (isset($_GET['invoice'])) { // afficher la facture
            $this->invoice();
        } else {
            $this->cart();
        }
    }
    // les fonctions qui suivent permettent d'afficher les différentes vues décrites précédemment, exemple, pour afficher la vue du compte
    // on fera appel à la fonction account()
    // dans ces fonctions, on établit un Manager, pour accéder à toutes les données de la table que l'on souhaite
    // puis lors de la création de la vue on dit quelles variables on veut avoir à disposition dans la vue
    private function cart()
    {
        $this->_articleManager = new ArticleManager;
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_orderManager = new OrderManager;
        $this->_adminManager = new AdminManager;
        if (isset($_SESSION['customer_id'])) {
            $articles = $this->_articleManager->getArticles();
            $logins = $this->_loginManager->getSpeLog();
            $customers = $this->_customerManager->getSpeCustomers();
            $orders = $this->_orderManager->getOrdersCustomer();
            if (isset($_SESSION['statuspanier']) && $_SESSION['statuspanier'] == 2) {

                $this->_view = new View('CartPay');
                $this->_view->generate(
                    array(
                        'logins' => $logins,
                        'customers' => $customers,
                        'orders' => $orders,
                        'articles' => $articles
                    )
                );
            } else {
                $this->_view = new View('Cart');
                $this->_view->generate(
                    array(
                        'articles' => $articles
                    )
                );
            }
        } else {
            $logins = $this->_loginManager->getLog();
            $admin = $this->_adminManager->getAdmin();
            $customers = $this->_customerManager->getCustomers();
            $this->_view = new View('LoginCart');
            $this->_view->generate(
                array(
                    'logins' => $logins,
                    'customers' => $customers,
                    'admin' => $admin
                )
            );
        }
    }

    private function ModifyAdress()
    {
        $this->_deliveryAdressesManager = new Delivery_addressesManager;
        $this->_deliveryAdressesManager->createAdress();
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager;
        $customers = $this->_customerManager->getSpeCustomers();
        $this->_orderitemsManager = new OrderItemsManager;
        $this->_loginManager = new LoginManager;
        $logins = $this->_loginManager->getSpeLog();
        $orders = $this->_orderManager->getOrdersCustomer();
        $this->_orderManager->createOneOrder($_SESSION['totalCart']);
        foreach ($_SESSION['panier'] as $articlepanier):
            $this->_orderitemsManager->addOrderItem($articlepanier[0], $articlepanier[1]);
        endforeach;
        $this->_view = new View('CartPay');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers,
                'orders' => $orders,
                'articles' => $articles
            )
        );
    }

    private function paymentChecked()
    {
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_orderManager = new OrderManager;
        $this->_orderitemsManager = new OrderItemsManager;
        $this->_articleManager = new ArticleManager;
        $this->_orderManager->updatePaymentType(strval($_GET['payment']));
        $this->_orderManager->updateStatus($_SESSION['statuspanier']);
        $logins = $this->_loginManager->getSpeLog();
        $customers = $this->_customerManager->getSpeCustomers();
        $orders = $this->_orderManager->getOrdersCustomer();
        $ordersitems = $this->_orderitemsManager->getOrderItems();
        $articles = $this->_articleManager->getArticles();
        $this->_view = new View('Orders');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers,
                'orders' => $orders,
                'ordersitems' => $ordersitems,
                'articles' => $articles
            )
        );
    }

    private function ValiderCart()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_customerManager = new CustomerManager;
        $customers = $this->_customerManager->getSpeCustomers();
        $this->_loginManager = new LoginManager;
        $logins = $this->_loginManager->getSpeLog();
        $this->_view = new View('CartDel');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers,
                'articles' => $articles
            )
        );
    }
    private function ValiderPayment()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager;
        $customers = $this->_customerManager->getSpeCustomers();
        $this->_orderitemsManager = new OrderItemsManager;
        $this->_loginManager = new LoginManager;
        $logins = $this->_loginManager->getSpeLog();
        $orders = $this->_orderManager->getOrdersCustomer();
        $this->_orderManager->createOneOrder($_SESSION['totalCart']);
        foreach ($_SESSION['panier'] as $articlepanier):
            $this->_orderitemsManager->addOrderItem($articlepanier[0], $articlepanier[1]);
        endforeach;
        $this->_view = new View('CartPay');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers,
                'orders' => $orders,
                'articles' => $articles
            )
        );
    }
    private function invoice()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_deliveryAdressesManager = new Delivery_addressesManager;
        $this->_orderManager = new OrderManager;
        $orders = $this->_orderManager->getOrdersCustomer();
        $this->_orderitemsManager = new OrderItemsManager;
        $ordersitems = $this->_orderitemsManager->getOrderItems();
        $this->_customerManager = new CustomerManager;
        $customers = $this->_customerManager->getSpeCustomers();
        $delivery_adresses = $this->_deliveryAdressesManager->getAdresses();

        $this->_view = new View('Invoice');
        $this->_view->generatePDF(
            array(
                'orders' => end($orders),
                'delivery_addresses' => $delivery_adresses,
                'customers' => $customers,
                'ordersitems' => $ordersitems,
                'articles' => $articles
            )
        );
    }
}
?>