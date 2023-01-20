<?php 
// le manager d'un model récupère les méthodes qu'il veut de Model.php contenant les requêtes permettant d'obtenir l'information voulu
// par exemple la méthode souvent utiliser est getAll('nom de la table', 'nom du modèle de la table') qui permet d'obtenir TOUTES les informations d'une table
class CategorieManager extends Model{
    public function getCategories(){
        $this->getBdd();
        return $this->getAll('categories', 'Categorie');
    }
}
?>