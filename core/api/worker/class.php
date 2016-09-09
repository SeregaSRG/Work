<?php
class Worker{
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
        $workerInfoQuery = $mysqli->query("SELECT * FROM `workers` WHERE id='".$id."'");
        $workerInfoObj = $workerInfoQuery->fetch_object();
        return $workerInfoObj;
    }
    static function getInfoByID($id){
        global $mysqli;
        $workerInfoQuery = $mysqli->query("SELECT * FROM `workers` WHERE id='".$id."'");
        $workerInfoObj = $workerInfoQuery->fetch_object();
        return $workerInfoObj;
    }
    static function getInfoPhone($phone){
        global $mysqli;
        $workerInfoQuery = $mysqli->query("SELECT * FROM `workers` WHERE phone='".$phone."'");
        if (!$workerInfoQuery->num_rows){
            Response::error('202');
            exit();
        }
        $workerInfoObj = $workerInfoQuery->fetch_object();
        return $workerInfoObj;
    }
}