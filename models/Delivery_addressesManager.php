<?php 
// le manager d'un model récupère les méthodes qu'il veut de Model.php contenant les requêtes permettant d'obtenir l'information voulu
// par exemple la méthode souvent utiliser est getAll('nom de la table', 'nom du modèle de la table') qui permet d'obtenir TOUTES les informations d'une table
class Delivery_addressesManager extends Model{
    public function getAdresses(){
        $this->getBdd();
        return $this->getAll('delivery_addresses', 'Delivery_addresses');
    }

    public function createAdress(){
        $this->getBdd();
        return $this->createDelAdress($_SESSION['prenom'], $_SESSION['nom'], $_SESSION['adresse'], $_SESSION['pays'], $_SESSION['ville'], $_SESSION['codepost'], $_SESSION['tel'], $_SESSION['mail']);
    }  
}
?>