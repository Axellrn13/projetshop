<?php 
// Ce model est une entité faisant référence aux tables de la BD, c'est la méthode hydrate() qui récupère les valeurs de la table et les met dans les différentes _variables 
// portant le nom exacte des variables de la tables à l'aide des setters
class Delivery_addresses {
    private $_id;
    private $_firstname;
    private $_lastname;
    private $_add1;
    private $_add2;
    private $_city;
    private $_postcode;
    private $_phone;
    private $_email;


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
    
    public function setFirstname($firstname){
        if(is_string($firstname)){
            $this->_firstname = $firstname;
        }
    }
    public function setLastname($lastname){
        $this->_lastname = $lastname;
    }
    public function setAdd1($add1){
        $this->_add1 = $add1;
    }
    public function setAdd2($add2){
        $this->_add2 = $add2;
    }
    public function setCity($city){
        $this->_city = $city;
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


    // GETTERS
    public function id(){
        return $this->_id;
    }
    public function firstname(){
        return $this->_firstname;
    }
    public function lastname(){
        return $this->_firstname;
    }
    public function add1(){
        return $this->_add1;
    }
    public function add2(){
        return $this->_add2;
    }
    public function city(){
        return $this->_city;
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
}
?>