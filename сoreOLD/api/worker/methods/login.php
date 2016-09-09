<?php
    $user_pass=crypt(htmlspecialchars($_POST['password'], ENT_QUOTES), SALT);
	$phone=htmlspecialchars($_POST['phone']);
    $workerInfo=Worker::getInfoPhone($phone);

    if (hash_equals($workerInfo->password, $user_pass)){
        $token = Token::generate();
        Token::insert($workerInfo->id,$token);
        Response::send(array('token'=>$token));
    } else {
        Response::error('203');
    }