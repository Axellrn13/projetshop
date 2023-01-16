<?php 
class AdminManager extends Model{
    public function getAdmin(){
        $this->getBdd();
        return $this->getAll('admin', 'Admin');
    }
}
?>