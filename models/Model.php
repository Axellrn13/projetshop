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
}