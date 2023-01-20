<?php

require_once('views/View.php');
class ControllerAccount
{
    private $_view;
    private $_loginManager;
    private $_customerManager;
    private $_orderManager;
    private $_orderitemsManager;
    private $_articleManager;
    private $_deliveryAdressesManager;

    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['update'])) { // quand le client change des infos de son compte
            $this->updateAccount();
        } elseif (isset($_GET['updateAdress'])) { // s'il modifie son adresse on agit sur la table delivery_adresses
            $this->updateAdress();
        } elseif (isset($_GET['order'])) { // accéder à ses commandes
            $this->accountOrder();
        } elseif (isset($_GET['id'])) { // accéder à la facture de la commande portant l'id de la variable GET
            $this->factureId();
        } else {
            $this->account(); // accéder à la vue des infos du compte
        }
    }

 // les fonctions qui suivent permettent d'afficher les différentes vues décrites précédemment, exemple, pour afficher la vue du compte
 // on fera appel à la fonction account()
 // dans ces fonctions, on établit un Manager, pour accéder à toutes les données de la table que l'on souhaite
 // puis lors de la création de la vue on dit quelles variables on veut avoir à disposition dans la vue
    private function factureId()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_deliveryAdressesManager = new Delivery_addressesManager;
        $this->_orderManager = new OrderManager;
        $orders = $this->_orderManager->getOrdersWithID($_GET['id']);
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

    private function account()
    {
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $logins = $this->_loginManager->getSpeLog();
        $customers = $this->_customerManager->getSpeCustomers();


        $this->_view = new View('Account');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers
            )
        );
    }

    private function accountOrder()
    {
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_orderManager = new OrderManager;
        $this->_orderitemsManager = new OrderItemsManager;
        $this->_articleManager = new ArticleManager;
        $logins = $this->_loginManager->getSpeLog();
        $customers = $this->_customerManager->getSpeCustomers();
        $orders = $this->_orderManager->getOrdersCustomer();
        $articles = $this->_articleManager->getArticles();
        $ordersitems = $this->_orderitemsManager->getOrderItems();
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

    private function updateAccount()
    {
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_customerManager->updateCustomer();
        $logins = $this->_loginManager->getSpeLog();
        $customers = $this->_customerManager->getSpeCustomers();

        $this->_view = new View('Account');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers
            )
        );
    }

    private function updateAdress()
    {
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_customerManager->updateCustomer();
        $logins = $this->_loginManager->getSpeLog();
        $customers = $this->_customerManager->getSpeCustomers();
        $this->_deliveryAdressesManager = new Delivery_addressesManager;
        $this->_deliveryAdressesManager->createAdress();
        $this->_view = new View('Account');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers
            )
        );
    }
}

?>