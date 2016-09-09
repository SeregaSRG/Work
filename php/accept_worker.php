<?php
	include 'sql.php';
  
	$client_id=$token_user[2];
	$id = htmlspecialchars($_POST['id']);
	$sql = $mysqli->query("SELECT ticket_id, worker_id FROM `answers` WHERE id='".$id."'");
	$now_answer = mysqli_fetch_row($sql);
	$worker_id=$now_answer[1];
	$ticket_id=$now_answer[0];
	
	$sql = $mysqli->query("UPDATE tickets SET worker_id='".$worker_id."', closed='1' WHERE id='".$ticket_id."'");
	$sql = $mysqli->query("UPDATE answers SET closed='1' WHERE ticket_id='".$ticket_id."'");
	$sql = $mysqli->query("SELECT job_id FROM `tickets` WHERE id='".$ticket_id."'");
	$job_id = mysqli_fetch_row($sql); 
	$sql = $mysqli->query("INSERT INTO `deals` (`client_id`, `worker_id`, `job_id`) VALUES ('".$client_id."', '".$worker_id."', '".$job_id[0]."')"); 
	echo "Вы заключил сделку";
?>