<?php 

require_once('views/View.php');

class ControllerCart {
    private $_view;
    private $_articleManager;
    private $_orderManager;

        
    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
        }
        elseif (isset($_GET['valider'])) {
            $this->ValiderCart();
        }
        else
        {
            $this->cart();
        }
    }

    private function cart(){  
        $this->_articleManager = new ArticleManager;
        $articles=$this->_articleManager->getArticles();

        $this->_view = new View('Cart');
        $this->_view->generate(array(
            'articles' => $articles));
    }

    private function ValiderCart(){  
        $this->_articleManager = new ArticleManager;
        $articles=$this->_articleManager->getArticles();
        $this->_orderManager = new OrderManager;
        $orders=$this->_orderManager->getArticles();

        $this->_view = new View('Cart');
        $this->_view->generate(array(
            'articles' => $articles));
    }


}
?>