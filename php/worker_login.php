<?php
	include 'sql.php';
	function generateToken(){
		$length = rand(45, 55);
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$numChars = strlen($chars);
		$token = '';
		for ($i = 0; $i < $length; $i++) {
			$token .= substr($chars, rand(1, $numChars) - 1, 1);
		}
		return $token;
	}
    $user_pass=htmlspecialchars($_POST['password']);
	$user_pass_hash = crypt($user_pass, $salt);
	$phone=htmlspecialchars($_POST['phone']);
		$sql = $mysqli->query("SELECT password, id FROM `workers` where phone='".$phone."'");
		$row = mysqli_fetch_row($sql);
		if ($row[0] == $user_pass_hash && $row[0] != ''){
			$token = generateToken();
			$sql = $mysqli->query("INSERT INTO `tokens` (`user_id`,`token`) VALUES ('".$row[1]."', '".$token."')");
			$data = array();
			$data["token"] = $token;
			echo json_encode($data);
		} else {
			$data = array();
			$data["token"] = null;
			echo json_encode($data);
		}
?>