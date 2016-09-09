<?php
	include 'sql.php';
	include 'class/client.php';
	include 'class/response.php';

	$token=htmlspecialchars($_POST['token']);
	$client_id=Client::getId($token);
	$jod_id=htmlspecialchars($_POST['job_id']);
	$address=htmlspecialchars($_POST['address']);
	$coordinates=htmlspecialchars($_POST['coordinates']);
	$date=$_POST['date'];
	
		$sql = $mysqli->query("SELECT * FROM tickets WHERE client_id = '".$client_id."'  AND  job_id = '".$jod_id."'  AND  closed != '1' ");
		if (!$sql -> num_rows) {
			$sql = $mysqli->query("INSERT INTO `tickets` (`job_id`, `client_id`, `ticket_date`, `address`, `coordinates`) VALUES ('".$jod_id."', '".$client_id."', '".$date."', '".$address."', '".$coordinates."')");
			if ($sql){
				//echo "Тикет создан успешно";
				Response::send(array('code' => '101')); //"Тикет создан успешно"
			} else {
				//echo "Что-то пошло не так:".$client_id."-".$jod_id."-".$date;
				Response::error('110'); //"Что-то пошло не так"
			}
		} else {
			//echo "Вы уже создали тикет";
			Response::error('100'); //"Вы уже создали тикет"
		}
?>