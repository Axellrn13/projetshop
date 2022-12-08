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

    protected function createUser($username, $forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email, $password){
        $req=self::$_bdd->prepare("insert into customers (forname, surname, add1, add2, add3, postcode, phone, email) 
        values (?, ?, ?, ?, ?, ?, ?, ?);
        SET @id = (select max(id) from customers);
        insert into logins (customer_id,username,password) 
        values (@id, ?, ?);");
        $req->execute(array($forname, $surname, $add1, $add2, $add3, $postcode, $phone, $email,$username,$password));
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