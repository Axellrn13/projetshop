<?php 
// le manager d'un model récupère les méthodes qu'il veut de Model.php contenant les requêtes permettant d'obtenir l'information voulu
// par exemple la méthode souvent utiliser est getAll('nom de la table', 'nom du modèle de la table') qui permet d'obtenir TOUTES les informations d'une table
class OrderManager extends Model{
    public function getOrders(){
        $this->getBdd();
        return $this->getAll('orders', 'Order');
    }
    public function getOrdersCustomer(){
        $this->getBdd();
        return $this->getSpeValue('orders', 'Order','customer_id',$_SESSION['customer_id']);
    }

    public function getOrdersWithID($id){
        $this->getBdd();
        return $this->getValue('orders','Order',$id);
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

    public function updateStatusSpe($status, $orderid){
        $this->getBdd();
        return $this->updateOrderStatusSpe($status,$orderid);
    }  
    public function deleteOrder($orderid){
        $this->getBdd();
        return $this->deleteOrderSpe($orderid);
    }  
    public function updatePaymentType($payType){
        $this->getBdd();
        return $this->updatePayType($payType,$_SESSION['customer_id'], session_id());
    }  
}
?>