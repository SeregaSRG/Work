<?php
	$token=htmlspecialchars($_POST['token']);
	$jod_id=htmlspecialchars($_POST['job_id']);
	$address=htmlspecialchars($_POST['address']);
	$coordinates=htmlspecialchars($_POST['coordinates']);
	$date=$_POST['date'];
	$client_id=Token::getId($token);
	
		$sql = $mysqli->query("SELECT * FROM tickets WHERE client_id = '".$client_id."'  AND  job_id = '".$jod_id."'  AND  closed != '1' ");
		if (!$sql -> num_rows) {
			$sql = $mysqli->query("INSERT INTO `tickets` (`job_id`, `client_id`, `ticket_date`, `address`, `coordinates`) VALUES ('".$jod_id."', '".$client_id."', '".$date."', '".$address."', '".$coordinates."')");
			if ($sql){
				Response::send(array('code' => '100')); //"Тикет создан успешно"
			} else {
				Response::error('-2');
				exit();
			}
		} else {
			Response::error('101'); //"Вы уже создали тикет"
			exit();
		}
?>