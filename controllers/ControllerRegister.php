<?php 

require_once('views/View.php');
class ControllerRegister{
    private $_view;

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
        $this->_view = new View('Register');
        $this->_view->generate(array());
    }

}

?>