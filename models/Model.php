<?php

abstract class Model{
    private static $_bdd;

    //INSTANCIE LA CONNEXION A LA BDD
    private static function setBdd(){
        self::$_bdd=new PDO('mysql:host=localhost;dbname=web4shop;charset=utf8','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    //RECUPERE LA CONNEXION A LA BDD
    protected function getBdd(){
        if(self::$_bdd==null){
            self::setBdd();
            return self::$_bdd;
        }
    }

    //FONCTION QUI RETOURNE TOUT LES CHAMPS D'UNE TABLE
    protected function getAll($table, $obj){
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getValue($table, $obj, $id){
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table.' where id='.$id);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function updatePayType($payment_type,$custid,$sessionid){
        $req=self::$_bdd->prepare("SET @orderid = (select max(id) from orders where customer_id=?);
        update orders set payment_type=?, session=? where id=@orderid;");
        $req->execute(array($custid,$payment_type,$sessionid));
        $req->closeCursor();
    }

    protected function updateOrderStatus($custid,$status){
        $req=self::$_bdd->prepare("SET @orderid = (select max(id) from orders where customer_id=?);
        update orders set status=? where id=@orderid;");
        $req->execute(array($custid,$status));
        $req->closeCursor();
    }

    protected function updateOrderStatusSpe($status,$order_id){
        $req=self::$_bdd->prepare("update orders set status=? where id=?;");
        $req->execute(array($status,$order_id));
        $req->closeCursor();
    }

    protected function updateQuantityArticle($id,$qty,$description,$price){
        $req=self::$_bdd->prepare("update products set quantity=?, description=?, price=? where id=?;");
        $req->execute(array($qty,$description,$price,$id));
        $req->closeCursor();
    }

    protected function deleteOrderSpe($order_id){
        $req=self::$_bdd->prepare("DELETE FROM orders WHERE id=?");
        $req->execute(array($order_id));
        $req->closeCursor();
    }

    protected function createOrder($firstname, $lastname, $customer_id, $total, $registered){
        $req=self::$_bdd->prepare("SET @deliveryId = (select id from delivery_addresses where firstname = ? and lastname = ?);
        insert into orders (status, date, customer_id, total, registered, delivery_add_id) 
        values (2, curdate(),?,?,?,@deliveryId);
        ");
        $req->execute(array($firstname, $lastname, $customer_id, $total, $registered));
        $req->closeCursor();
    }

    protected function createOrderitems($product_id, $quantity){
        $req=self::$_bdd->prepare("SET @orderid = (select max(id) from orders);
        insert into orderitems (order_id, product_id, quantity) 
        values (@orderid,?,?);
        ");
        $req->execute(array($product_id, $quantity));
        $req->closeCursor();
    }


    protected function createUser($username, $forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email, $password){
        $req=self::$_bdd->prepare("insert into customers (forname, surname, add1, add2, add3, postcode, phone, email,registered) 
        values (?, ?, ?, ?, ?, ?, ?, ?,1);
        SET @id = (select max(id) from customers);
        insert into logins (customer_id,username,password) 
        values (@id, ?, ?);");
        $req->execute(array($forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email,$username,$password));
        $req->closeCursor();
        header("Location: logout.php");
    }
    protected function createDelAdress($firstname, $lastname, $add1, $add2, $city, $postcode, $phone, $email){
        $req=self::$_bdd->prepare("IF (SELECT COUNT(1) FROM delivery_addresses WHERE firstname = ? AND lastname = ?) > 0
        THEN 
          UPDATE delivery_addresses SET add1 = ?, add2 = ?, city = ?, postcode = ?, phone= ?, email = ? WHERE firstname = ? AND lastname = ?;
        ELSE
          INSERT INTO delivery_addresses (firstname, lastname, add1, add2, city, postcode, phone, email) 
            VALUES (?,?,?,?,?,?,?,?);
        END IF;;");
        $req->execute(array($firstname, $lastname, $add1, $add2, $city, $postcode, $phone, $email,$firstname, $lastname,$firstname, $lastname,$add1, $add2, $city, $postcode, $phone, $email));
        $req->closeCursor();
    }

    protected function getAllCat($table, $obj, $cat){
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table. ' where cat_id='.$cat);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function updateUser($username, $forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email,$id){
        $req=self::$_bdd->prepare("update customers set forname=?, surname=?, add1=?, add2=?, add3=?, postcode=?, phone=?, email=? where id=?;
        update logins set username=? where customer_id=?;");
        $req->execute(array($forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email,$id,$username,$id));
        $req->closeCursor();
    }
    protected function getValueReview($table, $obj, $id){
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table.' where id_product='.$id);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getSpeValue($table, $obj,$id_name, $id){
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table.' where '.$id_name.'='.$id);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function getLogin($table, $obj,$username){
        $this->getBdd();
        $var=[];
        $req=self::$_bdd->prepare('select * from '.$table.' where username ='.$username);
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
        $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();

    }
}