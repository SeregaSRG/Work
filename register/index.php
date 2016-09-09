<!DOCTYPE html>
<head>
	<title>Easy Work - подтверждение регстрации</title>
	<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=360, height=device-height" />
    <meta name="format-detection" content="telephone=no" />
	<meta charset="utf-8">
</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title" id="center">Easy work</span>
    </div>
  </header>
  <main class="mdl-layout__content">
    <div class="page-content">

<!-- Login -->
<div id="log-menu">
	
	<div class="mdl-card mdl-cell mdl-cell--4-col mdl-shadow--4dp center" style="text-align: center">
	<div class="mdl-card__title">
	  <h1 class="mdl-card__title-text center">Подтверждение регистрации</h1>
	</div>
	<div class="mdl-card__supporting-text" id="info">
		<form>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<label for="phone" class="mdl-textfield__label">Телефон</label>
				<input type="tel" class="mdl-textfield__input" id="phone" pattern="-?[0-9]*(\.[0-9]+)?"/>
				<span class="mdl-textfield__error">Номер телефона должен содержать только цифры</span>
			</div>
			<button class="mdl-button mdl-js-button" onclick="()">Выслать код подтверждения</button>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<label for="code" class="mdl-textfield__label">Проверочный код</label>
				<input type="tel" class="mdl-textfield__input" id="code" pattern="-?[0-9]*(\.[0-9]+)?"/>
				<span class="mdl-textfield__error">Проверочный код должен содержать только цифры</span>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<label for="password" class="mdl-textfield__label">Пароль</label>
				<input type="password" class="mdl-textfield__input" id="password" />
				<span class="mdl-textfield__error">Некорректный пароль</span>
			</div>

		</form>
	</div>
	<div class="mdl-card__actions mdl-card--border">
		<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored " onclick="accept_mail()">Подтвердить данные</button>
	</div>
	</div>
</div>
<!-- Login -->

	
</div>
</main>
</div>

	<link href="https://easywork.su/material/material.min.css" rel="stylesheet">
	<link href="https://easywork.su/css/my.css" rel="stylesheet">
	<link href="https://easywork.su/css/main.css" rel="stylesheet">
	<script src="https://easywork.su/js/jquery-1.12.0.min.js"></script> 
	<script src="https://easywork.su/js/AJAX.js"></script>
	<script src="https://easywork.su/js/text.js"></script>
	<script src="https://easywork.su/material/material.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<?php
$mail_hash2=htmlspecialchars($_GET['mail']);
$user_type=htmlspecialchars($_GET['t']);
?>
	<script>
		function accept_mail() {
			$.post('https://easywork.su/php/accept_mail.php', {
					'phone':$('#phone').val(),
					'password':$('#password').val(),
					'address':$('#address').val(),
					'user_type':'<?php echo $user_type;?>',
					'mail_hash2':'<?php echo $mail_hash2;?>'},
				function(data) {
					myalert(data);
					console.log(data);
					if (data=="Вы успешно подтвердили email клиента"){
						console.log('1');
						setTimeout( 'window.location.replace("http://u.easywork.su/")', 1500 );
					} else if (data=="Вы успешно подтвердили email рабочего"){
						console.log('1');
						setTimeout( 'window.location.replace("http://w.easywork.su/")', 1500 );
					}
				});
		}
		function () {
			
		}
	</script>

<div aria-live="assertive" aria-atomic="true" aria-relevant="text" class="mdl-snackbar mdl-js-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button type="button" class="mdl-snackbar__action"></button>
</div>

</div>
  </main>
</div>

</body>
</html>




</body>
</html>