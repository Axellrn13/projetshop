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



    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['totalCart'])) {
            $this->ValiderCart();
            $_SESSION['panierstatus'] = 1;
            $_SESSION['totalCart'] = $_GET['totalCart'];
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
        $logins=$this->_loginManager->getSpeLog();
        $customers=$this->_customerManager->getSpeCustomers();
        if ($_SESSION['panierstatus'] == 0) {
            $this->_view = new View('Cart');
            $this->_view->generate(
                array(
                    'articles' => $articles
                )
            );
        } elseif ($_SESSION['panierstatus'] == 1) {
            $this->_orderManager->updateStatus($_SESSION['panierstatus']);
            $this->_view = new View('CartDel');
            $this->_view->generate(
                array(
                    'articles' => $articles,
                    'logins' => $logins,
                    'customers' => $customers
                )
            );
        } elseif ($_SESSION['panierstatus'] == 2) {
            $this->_orderManager->updateStatus($_SESSION['panierstatus']);
            $this->_view = new View('CartPay');
            $this->_view->generate(
                array(
                    'articles' => $articles,
                    'logins' => $logins,
                    'customers' => $customers
                )
            );
        }
    }

    private function ValiderCart()
    {
        $this->_articleManager = new ArticleManager;
        $articles = $this->_articleManager->getArticles();
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager;
        $customers=$this->_customerManager->getSpeCustomers();
        $this->_orderitemsManager = new OrderItemsManager;
        $this->_loginManager = new LoginManager;
        $logins=$this->_loginManager->getSpeLog();
        $this->_orderManager->createOneOrder($_GET['totalCart']);
        $orders=$this->_orderManager->getOrdersCustomer();

        foreach ($_SESSION['panier'] as $articlepanier):
            $orderitems = $this->_orderitemsManager->addOrderItem($articlepanier[0], $articlepanier[1]);
        endforeach;
        $this->_view = new View('CartDel');
        $this->_view->generate(array(
            'logins' => $logins,
            'customers' => $customers,
            'orders' => $orders,
            'articles' => $articles));
    }


}
?>