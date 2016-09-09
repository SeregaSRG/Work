<?php
/*
private function callApi( $method, $params) {
	$url = sprintf(
		"https://api.telegram.org/bot%s/%s",
		Config::get('telegram.token'),
		$method
	);

	$ch = curl_init();
	curl_setopt_array( $ch, array(
		CURLOPT_URL             => $url,
		CURLOPT_POST                => TRUE,
		CURLOPT_RETURNTRANSFER  => TRUE,
		CURLOPT_FOLLOWLOCATION  => FALSE,
		CURLOPT_HEADER          => FALSE,
		CURLOPT_TIMEOUT         => 10,
		CURLOPT_HTTPHEADER      => array( 'Accept-Language: ru,en-us'),
		CURLOPT_POSTFIELDS      => $params,

	));

	$response = curl_exec($ch);
	return json_decode( $response);
}
*/
$content = "";
$fp=fopen("https://api.telegram.org/bot209125580:AAGAjEDteiwAAmuuCh10ue0T74qVEvdAcvU/getUpdates","r");
while(!feof($fp))
{
	$content .= fread($fp,1024);
}
fclose($fp);
echo $content;
?>