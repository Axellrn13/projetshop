<?php 
class LoginManager extends Model{
    public function getLog($username){
        $this->getBdd();
        return $this->getLogin('logins', 'Login', $username);
    }
}
?>