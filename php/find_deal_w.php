<?php
	include 'sql.php';
  
	$worker_id=$token_user[2]; 
		
		$sql = $mysqli->query("SELECT * FROM `deals` WHERE worker_id='".$worker_id."' AND (closed_u!='1' OR closed_w!='1')");
		
		while ($now_deal = mysqli_fetch_row($sql)){

					$sql_client = $mysqli->query("SELECT * FROM `clients` WHERE id='".$now_deal[1]."'"); 
					$now_client = mysqli_fetch_row($sql_client);
					
					if($now_deal[6]=='1'){
						$U_C="<i class=\"material-icons\" style='color:#00BFA5'>done</i>"; 
					} else if($now_deal[6]=='0'){
						$U_C="<i class=\"material-icons\" style='color:#BDBDBD'>done</i>";
					} else if($now_deal[6]=='-1'){
						$U_C="<i class=\"material-icons\" style='color:#DD2C00'>error</i>";
					}
					
					if($now_deal[7]==1){
						$W_C="<i class=\"material-icons\" style='color:#00BFA5'>done</i>";
						$disabled = "disabled";
					} else if($now_deal[7]=='0'){
						$W_C="<i class=\"material-icons\" style='color:#BDBDBD'>done</i>";
						$disabled = "";
					} else if($now_deal[7]=='-1'){
						$W_C="<i class=\"material-icons\" style='color:#DD2C00'>error</i>";  
						$disabled = "";
					}
					
					echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp'>
						<div class='mdl-card__title'>
							<h1 class='mdl-card__title-text'>Заключенная сделка</h1>
							".$U_C.$W_C." 
						</div>
						<div class='mdl-card__supporting-text' id='info'>
							<p>Имя рабочего: ".$now_client[1]."</p>
							<p>Фамилия рабочего: ".$now_client[2]."</p>
							<p>Адрес рабочего: ".$now_client[3]."</p>
						</div>
						<div class='mdl-card__actions mdl-card--border'>
							<button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored \" onclick=\"accept_deal_w(".$now_deal[0].");this.disabled=1;find_deal_w();\" ".$disabled.">Сделка завершилась</button>
						</div>
						</div>";					


		}  
?>