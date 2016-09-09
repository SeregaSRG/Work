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
class JobId{
    public function __construct(){

    }
    static function getJobName($id){
        switch ($id) {
            case 1:
                return "Маляр";
                break;
            case 2:
                return "Каменщик";
                break;
            case 3:
                return "Доставка кирпичей";
                break;
            case 4:
                return "Доставка бетона";
                break;

        }
    }
}