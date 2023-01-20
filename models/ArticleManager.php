<?php 
// le manager d'un model récupère les méthodes qu'il veut de Model.php contenant les requêtes permettant d'obtenir l'information voulu
// par exemple la méthode souvent utiliser est getAll('nom de la table', 'nom du modèle de la table') qui permet d'obtenir TOUTES les informations d'une table
class ArticleManager extends Model{
    public function getArticles(){
        $this->getBdd();
        return $this->getAll('products', 'Article');
    }

    public function getArticleSpe($id){
        $this->getBdd();
        return $this->getValue('products', 'Article', $id);
    }

    public function getArticleCat($cat){
        $this->getBdd();
        return $this->getAllCat('products', 'Article',$cat);
    }

    public function updateQuantity(){
        $this->getBdd();
        return $this->updateQuantityArticle($_SESSION['idToModify'],$_SESSION['qtyToModify'],$_SESSION['descToModify'],$_SESSION['priceToModify']);
    }
}
?>