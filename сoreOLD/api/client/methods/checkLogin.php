<?php
	$token=htmlspecialchars($_POST['token'], ENT_QUOTES);
	if (!Token::isClosed($token)) {
        Response::send(array('code'=>'300'));
	} else {
        Response::error('301');
    }
