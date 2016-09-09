<?php
	include 'sql.php';
  
	$worker_id=$token_user[2];
	$deal_id=htmlspecialchars($_POST['deal_id']); 
		
	$sql = $mysqli->query("UPDATE deals SET closed_w='1' WHERE id='".$deal_id."' AND worker_id='".$worker_id."'");
	
	echo "Вы успешно закрыли сделку";
?>