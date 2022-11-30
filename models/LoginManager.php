<?php 
class LoginManager extends Model{
    public function getLog(){
        $this->getBdd();
        return $this->getAll('logins', 'Login');
    }
}
?>