<?php 

require_once('views/View.php');
class ControllerRegister{
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
            $this->register();
        }
    }

    private function register(){  
        $this->_loginManager = new LoginManager;
        $this->_customerManager = new CustomerManager;
        $logins=$this->_loginManager->getLog();
        $customers=$this->_customerManager->getCustomers();

        $this->_view = new View('Register');
        $this->_view->generate(array(
            'logins' => $logins,
            'customers' => $customers));
    }

}

?>