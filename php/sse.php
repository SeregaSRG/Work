<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header("Access-Control-Allow-Origin:*");

function push (){
	$user_id=htmlspecialchars($_GET['id']);
	$data = array();
	$data["answers"] = rand(0,100);
	$data["deals"] = rand(0,100);
	echo "data:".json_encode($data)."\n\n";
	flush();
}
sleep(10);
push();

?>