<?php
header('Content-type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin:*");
mb_internal_encoding("UTF-8");
session_start();

define('HOME_DIR',dirname(__FILE__));
require_once HOME_DIR.'/config.php';

require_once HOME_DIR.'/libraries/base.php';
require_once HOME_DIR.'/libraries/response.php';
require_once HOME_DIR.'/libraries/token.php';
require_once HOME_DIR.'/libraries/jobDecoder.php';

require_once HOME_DIR.'/api/client/class.php';
require_once HOME_DIR.'/api/worker/class.php';

$mysqli = Base::connect();

$response = new Response();

$addressWithoutGet = explode('?',htmlspecialchars($_SERVER['REQUEST_URI'],ENT_QUOTES));
$addressPieces = explode('/',htmlspecialchars($addressWithoutGet[0],ENT_QUOTES));

switch($addressPieces[1]){
    case 'api':
        $groupandmethod = explode('.',htmlspecialchars($addressPieces[2],ENT_QUOTES));
        $group = $groupandmethod[0];
        $method = $groupandmethod[1];
        
        require HOME_DIR.'/api/'.$group.'/methods/'.$method.'.php';
        break;
}