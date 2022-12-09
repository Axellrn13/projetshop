<?php 
class CustomerManager extends Model{
    public function getCustomers(){
        $this->getBdd();
        return $this->getAll('customers', 'Customer');
    }
    public function getSpeCustomers(){
        $this->getBdd();
        return $this->getSpeValue('customers', 'Customer','id',$_SESSION['customer_id']);
    }


    public function createCustomer(){
        $this->getBdd();
        return $this->createUser($_SESSION['username'],$_SESSION['nom'],$_SESSION['prenom'],"","","",$_SESSION['codepost'],$_SESSION['tel'],$_SESSION['mail'],$_SESSION['mdp']);
    }    
    public function updateCustomer(){
        $this->getBdd();
        return $this->updateUser($_SESSION['username'],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['adresse'],$_SESSION['pays'],$_SESSION['ville'],$_SESSION['codepost'],$_SESSION['tel'],$_SESSION['mail'],$_SESSION['customer_id']);
    }   
}
?>