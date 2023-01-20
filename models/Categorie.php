<?php 
// Ce model est une entité faisant référence aux tables de la BD, c'est la méthode hydrate() qui récupère les valeurs de la table et les met dans les différentes _variables 
// portant le nom exacte des variables de la tables à l'aide des setters
class Categorie {
    private $_id;
    private $_name;

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

    // GETTERS
    public function id(){
        return $this->_id;
    }
    public function name(){
        return $this->_name;
    }
}
?>