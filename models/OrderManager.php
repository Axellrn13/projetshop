<?php 
class OrderManager extends Model{
    public function getOrdersCustomer(){
        $this->getBdd();
        return $this->getSpeValue('orders', 'Order','customer_id',$_SESSION['customer_id']);
    }
    public function createOneOrder($payment_type, $status, $total){
        $this->getBdd();
        $isRegistered = 0;
        if(isset($_SESSION['username'])){
            $isRegistered = 1;
        }
        $session_id = session_id();
        return $this->createOrder($_SESSION['customer_id'], $isRegistered, $payment_type, $status, $session_id, $total);
    }    

}
?>