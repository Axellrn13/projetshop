<?php 
class ArticleManager extends Model{
    public function getArticles(){
        $this->getBdd();
        return $this->getAll('products', 'Article');
    }
    
    public function getArticleCat($cat){
        $this->getBdd();
        return $this->getAllCat('products', 'Article',$cat);
    }

    public function getArticleSpe($id){
        $this->getBdd();
        return $this->getValue('products', 'Article', $id);
    }
}
?>