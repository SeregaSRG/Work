<?php
	header("Access-Control-Allow-Origin:*");
	header("Content-Type: text/html; charset=utf-8");
	$salt="aL5*";
	$db_host="mysql.hostinger.ru";
	$db_user="u195353297_user";
	$db_pass="3YChU35UVS";
	$db_name="u195353297_main";
	$mysqli = @new mysqli($db_host,$db_user,$db_pass,$db_name);
	if (mysqli_connect_errno()) {
		echo "Подключение невозможно: ".mysqli_connect_error();
	}
	$token=htmlspecialchars($_POST['token']);
	$sql  = $mysqli->query("SELECT * FROM `tokens` WHERE token='".$token."' AND closed='0'");
	$token_user = mysqli_fetch_row($sql);
?>