<?php 

require_once('views/View.php');
class ControllerLogin{
    private $_articleManager;
    private $_view;

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
        $this->_view = new View('Login');
        $this->_view->generate(array());
    }

}

?>