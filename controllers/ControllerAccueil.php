<?php

require_once('views/View.php');
require_once('FPDF/fpdf.php');

class ControllerAccueil
{
    private $_articleManager;
    private $_categorieManager;
    private $_reviewManager;
    private $_customerManager;
    private $_orderManager;
    private $_orderItemsManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['id'])) { // accéder à la vue détailler d'un article pour voir ses reviews, ses quantités, sa description..
            $this->product();
        } elseif (isset($_GET['categorie'])) { // accéder à la catégorie d'article qu'on veut
            $this->articleCat();
        } elseif (isset($_GET['cartArticleId'])) { // lorsqu'on ajoute un article au panier on exécute cette fonction
            $this->addToCart();
        } elseif (isset($_GET['admin'])) { // accéder à la vue article administrateur
            $this->articleAdmin();
        } elseif (isset($_GET['order'])) { // accéder à la vue commande administrateur
            $this->OrderAdmin();
        } elseif (isset($_GET['annule'])) { // quand un administrateur veut annuler une commande
            $this->CancelOrder();
        } elseif (isset($_GET['valide'])) {// quand un administrateur veut valider une commande
            $this->CheckOrder();
        } elseif (isset($_GET['supprime'])) {// quand un administrateur veut supprimer une commande
            $this->DeleteOrder();
        } elseif (isset($_GET['modifyqty'])) {// quand un administrateur veut modifier la quantité d'article restant dans le stock
            $this->modifyqty();
        } else {
            $this->articles(); // accéder à l'accueil
        }
    }

    // les fonctions qui suivent permettent d'afficher les différentes vues décrites précédemment, exemple, pour afficher la vue du compte
    // on fera appel à la fonction account()
    // dans ces fonctions, on établit un Manager, pour accéder à toutes les données de la table que l'on souhaite
    // puis lors de la création de la vue on dit quelles variables on veut avoir à disposition dans la vue
    private function articleAdmin()
    {
        $this->_articleManager = new ArticleManager;
        $this->_categorieManager = new CategorieManager;
        $articles = $this->_articleManager->getArticles();
        $this->_view = new View('Admin');
        $this->_view->generate(
            array(
                'articles' => $articles
            )
        );
    }

    private function modifyqty()
    {
        $this->_articleManager = new ArticleManager;
        $this->_articleManager->updateQuantity();
        $articles = $this->_articleManager->getArticles();
        $this->_view = new View('Admin');
        $this->_view->generate(
            array(
                'articles' => $articles
            )
        );
    }

    private function DeleteOrder()
    {
        $this->_articleManager = new ArticleManager;
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager();
        $this->_orderItemsManager = new OrderItemsManager;
        $this->_orderManager->deleteOrder($_GET['supprime']);
        $articles = $this->_articleManager->getArticles();
        $orders = $this->_orderManager->getOrders();
        $customers = $this->_customerManager->getCustomers();
        $ordersitems = $this->_orderItemsManager->getOrderItems();
        $this->_view = new View('OrderAdmin');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'orders' => $orders,
                'customers' => $customers,
                'ordersitems' => $ordersitems
            )
        );
    }
    private function CancelOrder()
    {
        $this->_articleManager = new ArticleManager;
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager();
        $this->_orderItemsManager = new OrderItemsManager;
        $this->_orderManager->updateStatusSpe(-1, $_GET['annule']);
        $articles = $this->_articleManager->getArticles();
        $orders = $this->_orderManager->getOrders();
        $customers = $this->_customerManager->getCustomers();
        $ordersitems = $this->_orderItemsManager->getOrderItems();
        $this->_view = new View('OrderAdmin');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'orders' => $orders,
                'customers' => $customers,
                'ordersitems' => $ordersitems
            )
        );
    }
    private function CheckOrder()
    {
        $this->_articleManager = new ArticleManager;
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager();
        $this->_orderItemsManager = new OrderItemsManager;
        $this->_orderManager->updateStatusSpe(10, $_GET['valide']);
        $articles = $this->_articleManager->getArticles();
        $orders = $this->_orderManager->getOrders();
        $customers = $this->_customerManager->getCustomers();
        $ordersitems = $this->_orderItemsManager->getOrderItems();
        $this->_view = new View('OrderAdmin');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'orders' => $orders,
                'customers' => $customers,
                'ordersitems' => $ordersitems
            )
        );
    }


    private function OrderAdmin()
    {
        $this->_articleManager = new ArticleManager;
        $this->_orderManager = new OrderManager;
        $this->_customerManager = new CustomerManager();
        $this->_orderItemsManager = new OrderItemsManager;
        $articles = $this->_articleManager->getArticles();
        $orders = $this->_orderManager->getOrders();
        $customers = $this->_customerManager->getCustomers();
        $ordersitems = $this->_orderItemsManager->getOrderItems();
        $this->_view = new View('OrderAdmin');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'orders' => $orders,
                'customers' => $customers,
                'ordersitems' => $ordersitems
            )
        );
    }

    private function articles()
    {
        $this->_articleManager = new ArticleManager;
        $this->_categorieManager = new CategorieManager;
        $this->_customerManager = new CustomerManager;
        $articles = $this->_articleManager->getArticles();
        $categories = $this->_categorieManager->getCategories();

        $this->_view = new View('Accueil');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'categories' => $categories
            )
        );
    }

    private function articleCat()
    {
        $this->_articleManager = new ArticleManager;
        $this->_categorieManager = new CategorieManager;
        $articles = $this->_articleManager->getArticleCat($_GET['categorie']);
        $categories = $this->_categorieManager->getCategories();

        $this->_view = new View('Accueil');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'categories' => $categories
            )
        );
    }

    private function product()
    {
        $this->_articleManager = new ArticleManager;
        $this->_reviewManager = new ReviewManager;
        $articles = $this->_articleManager->getArticleSpe($_GET['id']);
        $reviews = $this->_reviewManager->getReview($_GET['id']);

        $this->_view = new View('Product');
        $this->_view->generate(
            array(
                'articles' => $articles,
                'reviews' => $reviews
            )
        );
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
        $this->_view->generate(
            array(
                'articles' => $articles
            )
        );
    }
}