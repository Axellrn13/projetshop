<?php

require_once('views/View.php');
class ControllerAccueil
{
    private $_articleManager;
    private $_categorieManager;
    private $_reviewManager;
    private $_customerManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['id'])) {
            $this->product();
        } elseif (isset($_GET['categorie'])) {
            $this->articleCat();
        } elseif (isset($_GET['cartArticleId'])) {
            $this->addToCart();
        } else {
            $this->articles();
        }
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager;
        $this->_categorieManager = new CategorieManager;
        $this->_customerManager = new CustomerManager;
        $articles = $this->_articleManager->getArticles();
        $categories = $this->_categorieManager->getCategories();

        $this->_view = new View('Accueil');
        $this->_view->generate(array(
            'articles' => $articles,
            'categories' => $categories
        ));
    }

    private function articleCat()
    {
        $this->_articleManager = new ArticleManager;
        $this->_categorieManager = new CategorieManager;
        $articles = $this->_articleManager->getArticleCat($_GET['categorie']);
        $categories = $this->_categorieManager->getCategories();

        $this->_view = new View('Accueil');
        $this->_view->generate(array(
            'articles' => $articles,
            'categories' => $categories
        ));
    }

    private function product()
    {
        $this->_articleManager = new ArticleManager;
        $this->_reviewManager = new ReviewManager;
        $articles = $this->_articleManager->getArticleSpe($_GET['id']);
        $reviews = $this->_reviewManager->getReview($_GET['id']);

        $this->_view = new View('Product');
        $this->_view->generate(array(
            'articles' => $articles,
            'reviews' => $reviews
        ));
    }

    private function addToCart()
    {
        $this->_articleManager = new ArticleManager;
        $this->_customerManager = new CustomerManager;
        $articles = $this->_articleManager->getArticles();
        $found = false;
        $index = 0;
        for ($i = 0; $i < count($_SESSION['panier']); $i++) {
            if ($_SESSION['panier'][$i][0] == $_GET['cartArticleId']) {
                $found = true;
                $index = $i;
                break;
            }
        }
        if ($found) {
            $_SESSION['panier'][$index][1] += 1;
        } else {
            array_push($_SESSION['panier'], [$_GET['cartArticleId'], 1]);
        }
        $this->_view = new View('Accueil');
        $this->_view->generate(array(
            'articles' => $articles
        ));
    }
}
