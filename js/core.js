var autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'), {
    language: 'ru',
    componentRestrictions: {country: 'ru'}
});

function up(){
	if ($('#password').val() !== $('#password_d').val()) {
		$('#password_d').css('background-color', '#EAB7B7');
		pass_is_correct = false;
	} else {
		$('#password_d').css('background-color', 'white');
		pass_is_correct = true; 
	}
}

function toggleJobSelect() {
	$('#main-card').toggle();
	$('#job-card').toggle();
}
function selectJob_save() {
	toggleJobSelect();
}

function toggleGeoSelect() {
	$('#main-card').toggle();
	$('#geo-card').toggle();
}


function showAddress() {
	adr=null;
	$('#address_main').show();
}

function isLogin(){
	console.log("isLogin");
	var is_login = window.localStorage.getItem("login");
	if (is_login == 'c' || is_login == 'w') {
		$("#log-menu").css("display","none");
		$("#main-menu").css("display","block");
		// Запуск скриптов при успешном входе
		//getBadge(); -----------------------------
		//start_badge_up(20000);
        if (is_login == 'w'){
            find_work();
        }
	} else {
		$("#reg-menu").css("display","block");
		$("#main-menu").css("display","none");
		end_badge_up();
	}
}

function logOut(){
	window.localStorage.setItem("token", null);
	window.localStorage.setItem("login", null);
	isLogin();
	end_badge_up();
}

function start_badge_up(updateTime) {
		badge_update_timer = setInterval(function(){
		getBadge();
	},updateTime)
}
function end_badge_up() {
	clearInterval(badge_update_timer);
}
function getBadge() {
	$.ajax({
		type: "POST",
		url: "https://easywork.su/php/badge.php",
		dataType: "json",
		data: {
			'token':window.localStorage.getItem("token"),
			'type':window.localStorage.getItem("login")
		},
		success: function(data) {
			console.log(data);
			if (data.answers != '0'){
				$('#answers_badge').addClass('mdl-badge');
				$('#answers_badge').attr("data-badge", data.answers);
			} else {
				$('#answers_badge').removeClass('mdl-badge');
				$('#answers_badge').attr("data-badge", '');
			}
			if (data.deals != '0'){
				$('#deals_badge').addClass('mdl-badge');
				$('#deals_badge').attr("data-badge", data.deals);
			} else{
				$('#deals_badge').removeClass('mdl-badge');
				$('#deals_badge').attr("data-badge", '');
			}
		},
		error: function(request, status, err) {
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
}

function alertError(code) {
	switch (code){
		case "101":
			myalert("Вы уже создали тикет");
			break;
		case "110":
			myalert("Ошибка добавленя в БД");
			break;
		case "201":
			myalert("Номер телефона занят");
			break;
		case "202":
			myalert("Номер не найден");
			break;
		case "203":
			myalert("Неверный пароль");
			break;
		case "400":
			myalert("Ошибка подключения к БД");
			break;
		case "-1":
			myalert("Неверный токен");
			break;
		case "-2":
			myalert("Ошибка SQL");
			break;
		default:
			myalert("Неверный код ошибки"+code);
	}
}


function alertDone(code) {
	switch (code){
		case "100":
			myalert("Тикет создан успешно");
			break;
		case "200":
			myalert("Вы успешно зарегистрированы");
			break;
		default:
			alert("Неверный код");
	}
}