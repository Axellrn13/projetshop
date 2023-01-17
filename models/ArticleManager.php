<?php 
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