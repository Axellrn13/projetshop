<?php 
class Customer {
    private $_id;
    private $_forname;
    private $_surname;
    private $_add1;
    private $_add2;
    private $_add3;
    private $_postcode;
    private $_phone;
    private $_email;
    private $_registered;


    public function __construct(array $data){
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


    // SETTERS
    public function setId($id){
        $id = (int)$id;
        if($id > 0)
        {
            $this->_id = $id;
        }
    }
    
    public function setForname($forname){
        if(is_string($forname)){
            $this->_forname = $forname;
        }
    }
    public function setSurname($surname){
        $this->_surname = $surname;
    }
    public function setAdd1($add1){
        $this->_add1 = $add1;
    }
    public function setAdd2($add2){
        $this->_add2 = $add2;
    }
    public function setAdd3($add3){
        $this->_add3 = $add3;
    }
    public function setPostcode($postcode){
        $this->_postcode = $postcode;
    }
    public function setPhone($phone){
        $this->_phone = $phone;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setRegistred($registred){
        $this->_registred = $registred;
    }


    // GETTERS
    public function id(){
        return $this->_id;
    }
    public function forname(){
        return $this->_forname;
    }
    public function surname(){
        return $this->_surname;
    }
    public function add1(){
        return $this->_add1;
    }
    public function add2(){
        return $this->_add2;
    }
    public function add3(){
        return $this->_add3;
    }
    public function postcode(){
        return $this->_postcode;
    }
    public function phone(){
        return $this->_phone;
    }
    public function email(){
        return $this->_email;
    }
    public function registered(){
        return $this->_registered;
    }
}
?>