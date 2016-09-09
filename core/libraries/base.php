<?php
class Base{
    static function connect(){
        $connection = new mysqli(MYSQL_HOSTNAME,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DBNAME);
        if($connection -> connect_errno){
            Response::error('400',$connection->connect_error);
            exit;
        } else {
            return $connection;
        }
    }
}