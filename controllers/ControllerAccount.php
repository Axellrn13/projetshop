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
        } elseif (isset($_GET['update'])) {
            $this->updateAccount();
        } elseif (isset($_GET['updateAdress'])) {
            $this->updateAdress();
        } elseif (isset($_GET['order'])) {
            $this->accountOrder();
        } elseif (isset($_GET['id'])) {
            $this->factureId();
        } else {
            $this->account();
        }
    }

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