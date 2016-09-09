<?php
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