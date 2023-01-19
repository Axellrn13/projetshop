<?php


require_once('views/View.php');
class ControllerRegister
{
    private $_view;
    private $_loginManager;
    private $_customerManager;

    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        } elseif (isset($_GET['creation'])) { // créer un compte à partir des données entrées par le client
            $this->registerAccount();
        } else {
            $this->register(); //accéder à la vue permettant de créer un compte
        }
    }


    // les fonctions qui suivent permettent d'afficher les différentes vues décrites précédemment, exemple, pour afficher la vue du compte
    // on fera appel à la fonction account()
    // dans ces fonctions, on établit un Manager, pour accéder à toutes les données de la table que l'on souhaite
    // puis lors de la création de la vue on dit quelles variables on veut avoir à disposition dans la vue
    private function register()
    {
        $this->_loginManager = new LoginManager;
        $logins = $this->_loginManager->getLog();

        $this->_view = new View('Register');
        $this->_view->generate(
            array(
                'logins' => $logins
            )
        );
    }

    private function registerAccount()
    {
        $this->_customerManager = new CustomerManager;
        $this->_customerManager->createCustomer();

        $this->_view = new View('Register');
        $this->_view->generate(array());

    }
}

?>