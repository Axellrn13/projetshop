<?php 
class OrderManager extends Model{
    public function getOrdersCustomer(){
        $this->getBdd();
        return $this->getSpeValue('orders', 'Order','customer_id',$_SESSION['customer_id']);
    }
    public function createOneOrder($total){
        $this->getBdd();
        $isRegistered = 0;
        if(isset($_SESSION['username'])){
            $isRegistered = 1;
        }
        return $this->createOrder($_SESSION['prenom'],$_SESSION['nom'],$_SESSION['customer_id'], $total, $isRegistered);
    }    

    public function updateStatus($status){
        $this->getBdd();
        return $this->updateOrderStatus($_SESSION['customer_id'],$status);
    }  
    public function updatePaymentType($payType){
        $this->getBdd();
        return $this->updatePayType($payType,$_SESSION['customer_id'], session_id());
    }  
}
?>