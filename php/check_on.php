<?php
	include 'sql.php';
  
	$worker_id=$token_user[2]; 
	$ticket_id=htmlspecialchars($_POST['ticket_id']); 
	$sql = $mysqli->query("SELECT * FROM answers WHERE worker_id = '".$worker_id."' AND ticket_id='".$ticket_id."'");
	if (!$sql -> num_rows ){
		$sql_client = $mysqli->query("SELECT client_id FROM tickets WHERE id='".$ticket_id."'");
		$client_id = mysqli_fetch_row ($sql_client);
		$sql = $mysqli->query("INSERT INTO `answers` (`ticket_id`, `worker_id`, `client_id`) VALUES ('".$ticket_id."', '".$worker_id."', '".$client_id[0]."')");
		echo "Вы успешно откликнулись";
	} else {
		echo "Вы уже откликнулись";
	}
?>