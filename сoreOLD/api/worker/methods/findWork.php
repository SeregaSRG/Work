<?php
    $token=htmlspecialchars($_POST['token']);

	$worker_id=Token::getId($token);
    $job_ids = Worker::getInfo($token)->job_ids;
	if ($job_ids){
        for ($i=0;$i<strlen($job_ids);$i++){
            $now_job_id = substr($job_ids,$i,1);
            $sql = $mysqli->query("SELECT * FROM `tickets` WHERE job_id='".$now_job_id."' AND closed != '1'");
            while ($row = mysqli_fetch_row($sql)) {
                $client_id = $row[2];
                $ticket_id = $row[0];
                if ($row[5]=='now'){
                    $when="Сейчас";
                } else {
                    $when="Другое время";
                }
                if ($row[6]==null){
                    $where = "<i class='forMap' onclick='showMap(".$row[7].")'>Место</i>";
                } else {
                    $where="<i class='forMap' onclick='showMap(".$row[7].")'>".$row[6]."</i>";
                }
                if ($row[7]==null){
                    $where = "<i>Не указано</i>";
                }
                $sql_client = $mysqli->query("SELECT name, surname FROM `clients` WHERE id='".$client_id."'");
                    $row_client = mysqli_fetch_row($sql_client);
                $sql_checked = $mysqli->query("SELECT * FROM `answers` WHERE ticket_id='".$ticket_id."' AND worker_id='".$worker_id."'");
                if (!$sql_checked -> num_rows) {
                    echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp'>
                            <div class='mdl-card__title'>
                              <h1 class='mdl-card__title-text'>Требуется: ".JobId::getJobName($now_job_id)."</h1>
                            </div>
                            <div class='mdl-card__supporting-text' id='info'>
                                <p>Имя: ".$row_client[0]."</p>
                                <p>Время: ".$when."</p>
                                <p>Адрес: ".$where."</p>
                            </div>
                            <div class='mdl-card__actions mdl-card--border'>
                                <button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored \"  onclick=\"check_on('".$ticket_id."');this.disabled=1;\">Откликнуться</button>
                            </div>
                            </div>";
                } else {
                    echo "<div class='mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp'>
                            <div class='mdl-card__title'>
                              <h1 class='mdl-card__title-text'>Требуется: ".JobId::getJobName($now_job_id)."</h1>
                            </div>
                            <div class='mdl-card__supporting-text' id='info'>
                                <p>Имя: ".$row_client[0]."</p>
                                <p>Время: ".$when."</p>
                                <p>Адрес: ".$where."</p>
                            </div>
                            <div class='mdl-card__actions mdl-card--border'>
                                <button class=\"mdl-button mdl-js-button mdl-button--raised\" disabled>Откликнуться</button>
                            </div>
                            </div>";
                }
            }
        }

    } else {
        echo "Что-то пошло не так";
    }
//Response::send(array("2"=>$job_ids));
?>