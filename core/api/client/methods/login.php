<?php
	$user_pass=crypt(htmlspecialchars($_POST['password'], ENT_QUOTES), SALT);
	$phone=htmlspecialchars($_POST['phone']);

	$clientInfo=Client::getInfoPhone($phone);
	if (hash_equals($clientInfo->password, $user_pass)){
		$token = Token::generate();
		Token::insert($clientInfo->id,$token);
		Response::send(array('token'=>$token));
	} else {
		Response::error('203');
	}
