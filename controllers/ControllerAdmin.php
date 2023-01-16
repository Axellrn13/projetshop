<?php 

require_once('views/View.php');
class ControllerAdmin{
    private $_view;
    private $_adminManager;

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
        }
        else
        {
            $this->admin();
        }
    }

    private function admin(){  
        $this->_adminManager = new AdminManager;
        $admin=$this->_adminManager->getAdmin();
        
        $this->_view = new View('Login');
        $this->_view->generate(array(
            'admin' => $admin));
    }

}

?>