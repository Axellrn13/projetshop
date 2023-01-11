<?php 
class OrderItemsManager extends Model{
    public function getOrderItems(){
        $this->getBdd();
        return $this->getAll('orderitems', 'OrderItems');
    }
    
    public function addOrderItem($product_id, $quantity){
        $this->getBdd();
        return $this->createOrderitems($product_id, $quantity);
    }
}
?>