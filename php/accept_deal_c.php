<?php
	include 'sql.php';
  
	$client_id=$token_user[2];
	$deal_id=htmlspecialchars($_POST['deal_id']); 
		
	$sql = $mysqli->query("UPDATE deals SET closed_u='1' WHERE id='".$deal_id."' and client_id='".$client_id."'");
	
	echo "Вы успешно закрыли сделку";
?>