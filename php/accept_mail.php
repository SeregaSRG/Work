<?php
include 'sql.php';
$mail_hash2=htmlspecialchars($_POST['mail_hash2']);
$user_type=htmlspecialchars($_POST['user_type']);
$user_pass=htmlspecialchars($_POST['password']);
$user_pass_hash=crypt($user_pass, $salt);
$user_pass_hash2=crypt($user_pass_hash, $salt);
$phone=htmlspecialchars($_POST['phone']);
$address=htmlspecialchars($_POST['address']);

if ($user_type=='c') {
	$sql = $mysqli->query("SELECT password, id FROM `clients` WHERE phone='".$phone."'");
	$now_user = mysqli_fetch_row($sql);
} else {
	$sql = $mysqli->query("SELECT password, id FROM `workers` WHERE phone='".$phone."'");
	$now_user = mysqli_fetch_row($sql);
}
if ($sql -> num_rows) {
	if ($mail_hash2==$user_pass_hash2 && $user_pass_hash==$now_user[0]){
		if ($user_type=='c'){
			$sql = $mysqli->query("UPDATE clients SET valid_email='1' WHERE id='".$now_user[1]."'");
			echo "Вы успешно подтвердили email клиента";
		} else {
			$sql = $mysqli->query("UPDATE workers SET valid_email='1' WHERE id='".$now_user[1]."'");
			echo "Вы успешно подтвердили email рабочего";
		}
	}else{
		echo "Вы ввели неверный пароль";
	}
} else {
	echo "Null";
}
?>