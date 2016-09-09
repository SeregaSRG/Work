<?php
include 'sql.php';

$client_id=$token_user[2];

$sql = $mysqli->query("SELECT * FROM `deals` WHERE client_id='".$client_id."' AND closed_u='1' AND closed_w='1'");

while ($now_deal = mysqli_fetch_row($sql)){

	$sql_worker = $mysqli->query("SELECT * FROM `workers` WHERE id='".$now_deal[2]."'");
	$now_worker = mysqli_fetch_row($sql_worker);

	if($now_deal[6]=='1'){
		$U_C="<i class=\"material-icons\" style='color:#00BFA5'>done</i>";
		$disabled = "disabled";
	} else if($now_deal[6]=='0'){
		$U_C="<i class=\"material-icons\" style='color:#BDBDBD'>done</i>";
		$disabled = "";
	} else if($now_deal[6]=='-1'){
		$U_C="<i class=\"material-icons\" style='color:#DD2C00'>error</i>";
		$disabled = "";
	}

	if($now_deal[7]==1){
		$W_C="<i class=\"material-icons\" style='color:#00BFA5'>done</i>";
	} else if($now_deal[7]=='0'){
		$W_C="<i class=\"material-icons\" style='color:#BDBDBD'>done</i>";
	} else if($now_deal[7]=='-1'){
		$W_C="<i class=\"material-icons\" style='color:#DD2C00'>error</i>";
	}

	echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp' id='center'>
						<div class='mdl-card__title'>
							<h1 class='mdl-card__title-text'>Заключенная сделка</h1>
							".$U_C.$W_C." 
						</div>
						<div class='mdl-card__supporting-text' id='info'>
							<p>Имя рабочего: ".$now_worker[1]."</p>
							<p>Фамилия рабочего: ".$now_worker[2]."</p>
							<p>Адрес рабочего: ".$now_worker[3]."</p>
						</div>
						<div class='mdl-card__actions mdl-card--border'>
						</div>
						</div>";


}
?>