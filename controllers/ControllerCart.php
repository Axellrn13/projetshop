<?php 

require_once('views/View.php');

class ControllerCart {
    private $_view;
    private $_articleManager;

        
    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1)
        {
            throw new Exception('Page introuvable');
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

}
?>