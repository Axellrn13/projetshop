<?php 
class ReviewManager extends Model{

    public function getReview($id){
        $this->getBdd();
        return $this->getValueReview('reviews', 'Review', $id);
    }
}
?>