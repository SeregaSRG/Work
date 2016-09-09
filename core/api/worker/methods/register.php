<?php
    $name=htmlspecialchars($_POST['name'], ENT_QUOTES);
	$surname=htmlspecialchars($_POST['surname'], ENT_QUOTES);
    $user_pass=htmlspecialchars($_POST['password'], ENT_QUOTES);
	$user_pass_hash = crypt($user_pass, SALT);
	$email=htmlspecialchars($_POST['email'], ENT_QUOTES);
	$phone=htmlspecialchars($_POST['phone'], ENT_QUOTES);
	$job_ids=json_decode($_POST['job_ids']);
	$organization=htmlspecialchars($_POST['organization'], ENT_QUOTES);
	if ($organization==''){
		$organization="Не указано";
	}
	$job_ids_str;
	for ($i=0;$i<count($job_ids);$i++){
		if ($job_ids[$i]<14&&$job_ids[$i]>0){
			$job_ids_str .= $job_ids[$i];
		}
	}
	$sql = $mysqli->query("SELECT name FROM `workers` where phone='".$phone."'");
	if (!$sql -> num_rows){
		$sql = $mysqli->query("INSERT INTO `workers` (`name`, `surname`, `email`, `phone`, `password`, `job_ids`, `organization`) VALUES ('".$name."', '".$surname."', '".$email."', '".$phone."', '".$user_pass_hash."', '".$job_ids_str."', '".$organization."')");
		if ($sql){
			$headers = "From: webmaster@easywork.su\r\nContent-type: text/html; charset=utf-8\r\n";
			$page = file_get_contents("http://easywork.su/register/mail.html");
			$text = str_replace("%rep%", crypt($user_pass_hash, $salt)."&t=w", $page);
			$text = str_replace("Да будет красивый текст!", "Здравствуйте, ".$name, $text);
			mail($email,"Подтверждение регистрации в сервисе Easy Work",$text, $headers);
			Response::send(array('code'=>'200'));
		} else {
			echo Response::error('-2');
		}
	} else {
        echo Response::error('201');
	}
?>