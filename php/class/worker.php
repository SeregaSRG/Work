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
    static function getClientInfo($id){
        global $mysqli;
        $clientInfoQuery = $mysqli->query("SELECT * FROM `clients` WHERE id='".$id."'");
        $clientInfoObj = $clientInfoQuery->fetch_object();
        return $clientInfoObj;
    }

    static function getId ($token){
        global $mysqli;
        $QueryByToken = $mysqli->query("SELECT * FROM `tokens` WHERE token='".htmlspecialchars($token, ENT_QUOTES)."' AND closed='0'");
        if(!$QueryByToken -> num_rows){
            return '-1';
        }
        $byTokenObj = $QueryByToken->fetch_object();
        return $byTokenObj->user_id;
    }
}