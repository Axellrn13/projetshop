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
        elseif(isset($_GET['creation']))
        {
            $this->registerAccount();
        }
        else
        {
            $this->register();
        }
    }

    private function register(){  
        $this->_loginManager = new LoginManager;
        $logins=$this->_loginManager->getLog();

        $this->_view = new View('Register');
        $this->_view->generate(array(
            'logins' => $logins
        ));
    }

    private function registerAccount(){  
        $this->_customerManager = new CustomerManager;
        $this->_customerManager->createCustomer();

        $this->_view = new View('Register');
        $this->_view->generate(array());
    }
}

?>