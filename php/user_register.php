<?php
	include 'sql.php';
	
    $name=htmlspecialchars($_POST['name']);
	$surname=htmlspecialchars($_POST['surname']);
    $user_pass=htmlspecialchars($_POST['password']);
	$user_pass_hash=crypt($user_pass, $salt);
	$email=addslashes( $_POST['email'] );  
	$phone=htmlspecialchars($_POST['phone']);
		
	$sql = $mysqli->query("SELECT name FROM `clients` where phone='".$phone."'");
	if (!$sql -> num_rows){
		$sql = $mysqli->query("INSERT INTO `clients` (`name`, `surname`, `email`, `phone`, `password`) VALUES ('".$name."', '".$surname."', '".$email."', '".$phone."', '".$user_pass_hash."')");
		
		if ($sql){
			echo "Вы успешно зарегистрированы";
			$headers = "From: webmaster@easywork.su\r\nContent-type: text/html; charset=utf-8\r\n";
			$page = file_get_contents("http://easywork.su/register/mail.html");
			$text = str_replace("%rep%", crypt($user_pass_hash, $salt)."&t=c", $page);
			$text = str_replace("Да будет красивый текст!", "Здравствуйте, ".$name, $text);
			mail($email,"Подтверждение регистрации в сервисе Easy Work",$text, $headers);
		} else {
			echo "Что-то пошло не так";
		}
	} else {
		echo "Телефон занят";
	}
?>