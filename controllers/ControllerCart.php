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


    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['totalCart'])) {
            $this->ValiderCart();
            $_SESSION['totalCart'] = $_GET['totalCart'];
        } elseif (isset($_GET['adressChecked'])) {
            $_SESSION['statuspanier'] = 2;
            $this->ValiderPayment();
        } elseif (isset($_GET['adressModified'])) {
            $_SESSION['statuspanier'] = 2;
            $this->ModifyAdress();
        } elseif (isset($_GET['payment'])) {
            $_SESSION['statuspanier'] = 3;
            $this->paymentChecked();
            unset($_SESSION['statuspanier']);
            unset($_SESSION['panier']);
        } else {
            $this->cart();
        }
    }

    private function cart()
    {
        $this->_articleManager = new ArticleManager;
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_orderManager = new OrderManager;
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
}


?>