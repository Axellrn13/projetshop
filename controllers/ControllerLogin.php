<?php 

require_once('views/View.php');
class ControllerLogin{
    private $_view;
    private $_loginManager;
    private $_customerManager;

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->login();
        }
    }

    private function login(){  
        $this->_loginManager = new LoginManager;
        $logins=$this->_loginManager->getLog();
        $this->_customerManager = new CustomerManager;
        $customers = $this->_customerManager->getCustomers();
        $this->_view = new View('Login');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers
            )
        );
    }

}

?>