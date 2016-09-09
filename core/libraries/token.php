<?php
class Token{
    static function generate(){
        return hash('sha512',uniqid(rand(), true));
    }
    static function insert($id,$token){
        global $mysqli;
        $insertToken=$mysqli->query("INSERT INTO `tokens` (`user_id`,`token`) VALUES ('".$id."', '".$token."')");
    }
    static function getId ($token){
        global $mysqli;
        $QueryByToken = $mysqli->query("SELECT * FROM `tokens` WHERE token='".htmlspecialchars($token, ENT_QUOTES)."' AND closed='0'");
        if(!$QueryByToken -> num_rows){
            Response::error('-1');
            exit();
        }
        $byTokenObj = $QueryByToken->fetch_object();
        return $byTokenObj->user_id;
    }
    static function isClosed($token) {
        global $mysqli;
        $QueryByToken = $mysqli->query("SELECT * FROM `tokens` WHERE token='".htmlspecialchars($token, ENT_QUOTES)."'");
        if(!$QueryByToken -> num_rows){
            Response::error('-1');
            exit();
        }
        $byTokenObj = $QueryByToken->fetch_object();
        return $byTokenObj->closed;
    }
}