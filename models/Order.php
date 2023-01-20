<?php

// Ce model est une entité faisant référence aux tables de la BD, c'est la méthode hydrate() qui récupère les valeurs de la table et les met dans les différentes _variables 
// portant le nom exacte des variables de la tables à l'aide des setters
class Order
{
    private $_id;
    private $_customer_id;
    private $_registered;
    private $_delivery_add_id;
    private $_payment_type;
    private $_date;
    private $_status;
    private $_session;
    private $_total;

    private $_stars;

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


    public function setCustomer_id($customer_id)
    {
        $customer_id = (int)$customer_id;
        if ($customer_id > 0) {
            $this->_customer_id = $customer_id;
        }
    }

    public function setRegistered($registered)
    {
        $this->_registered = $registered;
    }

    public function setDelivery_add_id($delivery_add_id)
    {
        $this->_delivery_add_id = $delivery_add_id;
    }

    public function setPayment_type($payment_type)
    {
        $this->_payment_type = $payment_type;
    }

    public function setDate($date)
    {
        $this->_date = $date;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function setSession($session)
    {
        $this->_session = $session;
    }
    public function setTotal($total)
    {
        $this->_total = $total;
    }

    // GETTERS
    public function id()
    {
        return $this->_id;
    }

    public function customer_id()
    {
        return $this->_customer_id;
    }

    public function registered()
    {
        return $this->_registered;
    }
    public function delivery_add_id()
    {
        return $this->_delivery_add_id;
    }
    public function payment_type()
    {
        return $this->_payment_type;
    }
    public function date()
    {
        return $this->_date;
    }
    public function status()
    {
        return $this->_status;
    }
    public function session()
    {
        return $this->_session;
    }
    public function total()
    {
        return $this->_total;
    }
}
