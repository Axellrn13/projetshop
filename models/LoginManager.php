<?php 
class LoginManager extends Model{
    public function getLog(){
        $this->getBdd();
        return $this->getAll('logins', 'Login');
    }
    public function getSpeLog(){
        $this->getBdd();
        return $this->getSpeValue('logins', 'Login','id',$_SESSION['id']);
    }
    public function getAdmin(){
        $this->getBdd();
        return $this->getAll('admin', 'Admin');
    }
}
?>