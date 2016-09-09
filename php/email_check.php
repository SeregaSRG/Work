<?php
	$email=$_POST['email'];
	
		$host="mysql.hostinger.ru";
		$user="u195353297_admin";
		$pass="42KjQ3yXg6"; //установленный вами пароль
		$db_name="u195353297_clien";
		
		$mysqli = @new mysqli($host,$user,$pass,$db_name);
		if (mysqli_connect_errno()) {
			echo "Подключение невозможно: ".mysqli_connect_error();
		}
		
		$sql = $mysqli->query("SELECT name FROM `clients` where email='".$email."'");
		$row = mysqli_fetch_row($sql);
		if (!$row[0])
		{
			echo "7";
		}
		else 
		{
			echo "Почта занята";
		}
?>