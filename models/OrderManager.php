<?php 
class OrderManager extends Model{
    public function getOrdersCustomer(){
        $this->getBdd();
        return $this->getSpeValue('orders', 'Order','customer_id',$_SESSION['customer_id']);
    }
}
?>