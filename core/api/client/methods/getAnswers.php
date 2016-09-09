<?php
	$token=htmlspecialchars($_POST['token'], ENT_QUOTES);
	$client_id=Token::getId($token);
	require HOME_DIR.'/api/worker/class.php';

		$sql = $mysqli->query("SELECT id, job_id, closed FROM `tickets` where client_id='".$client_id."'");
		while ($now_ticket = mysqli_fetch_row($sql)){
			if ($now_ticket[2]!='1') {
				$sql_answ = $mysqli->query("SELECT * FROM `answers` WHERE ticket_id='".$now_ticket[0]."'");
				while ($now_answers = mysqli_fetch_row($sql_answ)){
					$sql_worker = $mysqli->query("SELECT * FROM `workers` WHERE id='".$now_answers[2]."'");
					$now_worker = mysqli_fetch_row($sql_worker);
					
					echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp'>
						<div class='mdl-card__title'>
							<h1 class='mdl-card__title-text'>".JobId::getJobName($now_ticket[1])."</h1>
						</div>
						<div class='mdl-card__supporting-text' id='info'>
							<p>Имя: ".Worker::getInfoByID($now_answers[2])->name."</p>
							<p>Фамилия: ".Worker::getInfoByID($now_answers[2])->surname."</p>
							<p>Организация: ".Worker::getInfoByID($now_answers[2])->organization."</p>
						</div>
						<div class='mdl-card__actions mdl-card--border'>
							<button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored \" onclick=\"accept_worker(".$now_answers[0].");this.disabled=1;\">Заключить с ним сделку</button>
						</div>
						</div>";					
				} 
			}
		}
?>