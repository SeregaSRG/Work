<?php
	include 'sql.php';
	header('Content-Type: text/event-stream');
	header("Access-Control-Allow-Origin:*");

	$token=htmlspecialchars($_POST['token']);
	$type=htmlspecialchars($_POST['type']);
	$user_id = $token_user[2];

	$data = array();
	
	if ($type == 'c') {
		$sql  = $mysqli->query("SELECT * FROM `answers` WHERE client_id='".$user_id."' AND closed='0'");
		$sql2 = $mysqli->query("SELECT * FROM `deals` WHERE client_id='".$user_id."' AND (closed_u!='1' OR closed_w!='1')");
		echo json_encode(array(
			'answers' => $sql -> num_rows,
			'deals' => $sql2 -> num_rows
		));
		exit;
	} else if ($type == 'w') {
		$sql2 = $mysqli->query("SELECT * FROM `deals` WHERE worker_id='".$user_id."' AND (closed_u!='1' OR closed_w!='1')");
		echo json_encode(array('deals' => $sql2 -> num_rows));
		exit;
	}
?>