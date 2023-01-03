<?php 

require_once('views/View.php');
class ControllerAccount{
    private $_view;
    private $_loginManager;
    private $_customerManager;
    private $_orderManager;

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
        }
        elseif(isset($_GET['update']))
        {
            $this->updateAccount();
        }
        elseif(isset($_GET['order']))
        {
            $this->accountOrder();
        }
        else
        {
            $this->account();
        }
    }

    private function account(){  
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $logins=$this->_loginManager->getSpeLog();
        $customers=$this->_customerManager->getSpeCustomers();


        $this->_view = new View('Account');
        $this->_view->generate(array(
            'logins' => $logins,
            'customers' => $customers));
    }

    private function accountOrder(){  
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_orderManager = new OrderManager;
        $logins=$this->_loginManager->getSpeLog();
        $customers=$this->_customerManager->getSpeCustomers();
        $orders=$this->_orderManager->getOrdersCustomer();

        $this->_view = new View('Orders');
        $this->_view->generate(array(
            'logins' => $logins,
            'customers' => $customers,
            'orders' => $orders));
    }

    private function updateAccount(){  
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $this->_customerManager->updateCustomer();
        $logins=$this->_loginManager->getSpeLog();
        $customers=$this->_customerManager->getSpeCustomers();

        $this->_view = new View('Account');
        $this->_view->generate(array(
            'logins' => $logins,
            'customers' => $customers));
    }
}

?>