<?php 
class Article {
    private $_id;
    private $_name;
    private $_description;
    private $_image;
    private $_price;
    private $_quantity;
    private $_cat_id;

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
    
    public function setName($name){
        if(is_string($name)){
            $this->_name = $name;
        }
    }
    public function setDescription($description){
        if(is_string($description)){
            $this->_description = $description;
        }
    }
    public function setImage($image){
        $this->_image = $image;
    }

    public function setPrice($price){
        $this->_price = $price;
    }
    public function setQuantity($qty){
        $this->_quantity = $qty;
    }
    public function setCat($catid){
        $this->_cat_id = $catid;
    }

    // GETTERS
    public function id(){
        return $this->_id;
    }
    public function name(){
        return $this->_name;
    }
    public function description(){
        return $this->_description;
    }
    public function image(){
        return $this->_image;
    }
    public function price(){
        return $this->_price;
    }
    public function quantity(){
        return $this->_quantity;
    }
    public function cat_id(){
        return $this->_cat_id;
    }
}
?>