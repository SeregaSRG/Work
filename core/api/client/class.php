<?php
class Client{
    public $id;
    public $email;
    public $phone;
    public $password;
    public $emailConfirmed;
    public $phoneConfirmed;
    public $rating;
    public $name;
    public $surname;
    public $address;
    public function __construct(){

    }
    static function getInfo($token){
        global $mysqli;
        $id=Token::getId($token);
        $clientInfoQuery = $mysqli->query("SELECT * FROM `clients` WHERE id='".$id."'");
        $clientInfoObj = $clientInfoQuery->fetch_object();
        return $clientInfoObj;
    }
    static function getInfoPhone($phone){
        global $mysqli;
        $clientInfoQuery = $mysqli->query("SELECT * FROM `clients` WHERE phone='".$phone."'");
        if (!$clientInfoQuery->num_rows){
            Response::error('202');
            exit();
        }
        $clientInfoObj = $clientInfoQuery->fetch_object();
        return $clientInfoObj;
    }
}