<?php 
class CustomerManager extends Model{
    public function getCustomers(){
        $this->getBdd();
        return $this->getAll('customers', 'Customer');
    }
}
?>