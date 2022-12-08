<?php 
class CustomerManager extends Model{
    public function getCustomers(){
        $this->getBdd();
        return $this->getAll('customers', 'Customer');
    }

    public function createCustomer(){
        $this->getBdd();
        return $this->createUser($_SESSION['username'],$_SESSION['nom'],$_SESSION['prenom'],"","","",$_SESSION['codepost'],$_SESSION['tel'],$_SESSION['mail'],md5($_SESSION['mdp']));
    }

    
}
?>