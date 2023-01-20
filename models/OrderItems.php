<?php

// Ce model est une entité faisant référence aux tables de la BD, c'est la méthode hydrate() qui récupère les valeurs de la table et les met dans les différentes _variables 
// portant le nom exacte des variables de la tables à l'aide des setters
class OrderItems
{
    private $_id;
    private $_order_id;
    private $_product_id;
    private $_quantity;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }


    // SETTERS
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    public function setOrder_id($order_id)
    {
        $this->_order_id = $order_id;
    }

    public function setProduct_id($prodId)
    {
        $this->_product_id = $prodId;
    }
    public function setQuantity($qty)
    {
        $this->_quantity = $qty;
    }

    // GETTERS
    public function id()
    {
        return $this->_id;
    }
    public function order_id()
    {
        return $this->_order_id;
    }
    public function product_id()
    {
        return $this->_product_id;
    }
    public function quantity()
    {
        return $this->_quantity;
    }
}
