<?php 
// le manager d'un model récupère les méthodes qu'il veut de Model.php contenant les requêtes permettant d'obtenir l'information voulu
// par exemple la méthode souvent utiliser est getAll('nom de la table', 'nom du modèle de la table') qui permet d'obtenir TOUTES les informations d'une table
class LoginManager extends Model{
    public function getLog(){
        $this->getBdd();
        return $this->getAll('logins', 'Login');
    }
    public function getSpeLog(){
        $this->getBdd();
        return $this->getSpeValue('logins', 'Login','id',$_SESSION['id']);
    }
}
?>