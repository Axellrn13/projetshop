<?php 

require_once('views/View.php');

class ControllerCart {
    private $_view;
    private $_articleManager;
    private $_orderManager;
    private $_orderitemsManager;

        
    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
        }
        elseif (isset($_GET['totalCart'])) {
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
        $this->_orderitemsManager = new OrderItemsManager;
        $orders=$this->_orderManager->createOneOrder($_GET['totalCart']);
        foreach($_SESSION['panier'] as $articlepanier):
            $orders=$this->_orderitemsManager->addOrderItem($articlepanier[0],$articlepanier[1]);
        endforeach;
        $this->_view = new View('CartDel');
        $this->_view->generate(array(
            'articles' => $articles,
            'orders' => $orders));
    }


}
?>