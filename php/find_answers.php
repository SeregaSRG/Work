<?php
	include 'sql.php';
  
	$client_id=$token_user[2];
		$sql = $mysqli->query("SELECT id, job_id, closed FROM `tickets` where client_id='".$client_id."'");
		while ($now_ticket = mysqli_fetch_row($sql)){
			if ($now_ticket[2]!='1') {
				$sql_answ = $mysqli->query("SELECT * FROM `answers` WHERE ticket_id='".$now_ticket[0]."'");
				while ($now_answers = mysqli_fetch_row($sql_answ)){
					$sql_worker = $mysqli->query("SELECT * FROM `workers` WHERE id='".$now_answers[2]."'");
					$now_worker = mysqli_fetch_row($sql_worker);
					echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp'>
						<div class='mdl-card__title'>
							<h1 class='mdl-card__title-text'>Отклик рабочих</h1>
							<h1 class='mdl-card__title-text'>ID работы: ".$now_ticket[1]."</h1>
						</div>
						<div class='mdl-card__supporting-text' id='info'>
							<p>Имя: ".$now_worker[1]."</p>
							<p>Фамилия: ".$now_worker[2]."</p>
							<p>Адрес: ".$now_worker[3]."</p>
						</div>
						<div class='mdl-card__actions mdl-card--border'>
							<button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored \" onclick=\"accept_worker(".$now_answers[0].");this.disabled=1;\">Заключить с ним сделку</button>
						</div>
						</div>";					
				} 
			}
		}
?>