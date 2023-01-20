<?php 

// Ce model est une entité faisant référence aux tables de la BD, c'est la méthode hydrate() qui récupère les valeurs de la table et les met dans les différentes _variables 
// portant le nom exacte des variables de la tables à l'aide des setters
class Review {
    private $_id_product;
    private $_name_user;
    private $_photo_user;
    private $_title;
    private $_description;

    private $_stars;

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
    public function setId_product($id){
        $id = (int)$id;
        if($id > 0)
        {
            $this->_id_product = $id;
        }
    }
    

    public function setStars($stars){
        $stars = (int)$stars;
        if($stars > 0)
        {
            $this->_stars = $stars;
        }
    }

    public function setName_user($name){
        if(is_string($name)){
            $this->_name_user = $name;
        }
    }

    public function setPhoto_user($photo){
        if(is_string($photo)){
            $this->_photo_user = $photo;
        }
    }

    public function setTitle($title){
        if(is_string($title)){
            $this->_title = $title;
        }
    }

    public function setDescription($description){
        if(is_string($description)){
            $this->_description = $description;
        }
    }

    // GETTERS
    public function id(){
        return $this->_id_product;
    }

    public function stars(){
        return $this->_stars;
    }

    public function name(){
        return $this->_name_user;
    }
    public function photo_user(){
        return $this->_photo_user;
    }
    public function title(){
        return $this->_title;
    }
    public function description(){
        return $this->_description;
    }
}
?>