<?php 
class CategorieManager extends Model{
    public function getCategories(){
        $this->getBdd();
        return $this->getAll('categories', 'Categorie');
    }
}
?>