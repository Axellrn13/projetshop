<?php 
class Delivery_addressesManager extends Model{
    public function getAdresses(){
        $this->getBdd();
        return $this->getAll('delivery_adresses', 'Delivery_adresses');
    }

    public function createAdress(){
        $this->getBdd();
        return $this->createDelAdress($_SESSION['prenom'], $_SESSION['nom'], $_SESSION['adresse'], $_SESSION['pays'], $_SESSION['ville'], $_SESSION['codepost'], $_SESSION['tel'], $_SESSION['mail']);
    }  
}
?>