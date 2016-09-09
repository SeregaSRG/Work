<?php
/*
$headers = "From:leo_gladkov4@mail.ru\r\nContent-type: text/html; charset=utf-8\r\nDate: Wed, 20 Jun 666 20:18:47 -0400";

if (mail('monohrom99@mail.ru',"Подтверждение регистрации в сервисе Easy Work","Староста группы Ктбо1-1", $headers)){
	echo "1";
} else {
	echo "2";
}




include 'sql.php';
include 'class/class.php';
$token=htmlspecialchars($_POST['tkn']);
//echo (json_encode(Clinet::getId($token)));
$token = 'pyueEast6RMFoGGFpS0XHIRs8r7xY7DduXiZYAiTiVows';
echo Client::getClientInfo(Client::getId($token))->name;

 */

if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, 'http://web2.smsgorod.ru/sendsms.php?user=EASYWORK&pwd=EASYWORK8990&sadr=VIRTA&text='.$sms_text.'&dadr='.$phone);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    $out = curl_exec($curl);
    echo $out;
    curl_close($curl);
}
?>