<?php

require_once('views/View.php');
class ControllerLogin
{
    private $_view;
    private $_loginManager;
    private $_customerManager;
    private $_adminManager;

    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->login(); // afficher la vue permettant de se connecter
        }
    }
    // les fonctions qui suivent permettent d'afficher les différentes vues décrites précédemment, exemple, pour afficher la vue du compte
    // on fera appel à la fonction account()
    // dans ces fonctions, on établit un Manager, pour accéder à toutes les données de la table que l'on souhaite
    // puis lors de la création de la vue on dit quelles variables on veut avoir à disposition dans la vue
    private function login()
    {
        $this->_loginManager = new LoginManager;
        $logins = $this->_loginManager->getLog();
        $this->_customerManager = new CustomerManager;
        $this->_adminManager = new AdminManager;
        $admin = $this->_adminManager->getAdmin();
        $customers = $this->_customerManager->getCustomers();
        $this->_view = new View('Login');
        $this->_view->generate(
            array(
                'logins' => $logins,
                'customers' => $customers,
                'admin' => $admin
            )
        );
    }

}

?>