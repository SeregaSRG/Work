function checkLogin() {
	console.log("checkLogin");

	$('#loading').show();
	if (window.localStorage.getItem("token")!=null) {
		$.ajax({
			type: "POST",
			url: "http://core.easywork.su/api/client.checkLogin",
			dataType: "json",
			data: {
				'token': window.localStorage.getItem("token")
			},
			success: function (response) {
				console.log(response);
				if (response.status == "done") {
					isLogin();
				} else {
					window.localStorage.setItem("token", null);
					window.localStorage.setItem("login", null);
					isLogin();
				}
			},
			error: function (request, status, err) {
				myalert("Превышено время ожидания ответа от сервера");
			}
		});
	} else {
		isLogin();
	}
	$('#loading').hide();
}
function send_worker_register() {
	
	var job_ids = [];
	$('input[name=categoryReg]:checked').each(function () {
		job_ids.push($(this).val())
	});

	if (job_ids != "") {
		console.log(job_ids);
		$('#loading').show();
		$.ajax({
			type: "POST",
			url: "http://core.easywork.su/api/worker.register",
			dataType: "json",
			data: {
				'name': $('#user_name').val(),
				'surname': $('#user_surname').val(),
				'phone': $('#user_phone').val(),
				'password': $('#user_password').val(),
				'email': $('#user_email').val(),
				'job_ids': JSON.stringify(job_ids)
			},
			success: function(response) {
				$('#loading').hide();
				if (response.status=="done") {
					$("#log-menu").toggle();
					$("#reg-menu").toggle();
					myalert("Регистрация выполнена успешно");
				} else {
					alertError(response.errorcode);
				}
			},
			error: function(request, status, err) {
				$('#loading').hide();
				myalert ("Превышено время ожидания ответа от сервера");
			}
		});
	} else {
		myalert("Выберите категорию");
	}
}

function send_worker_login() {
	console.log("Login");
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/worker.login",
		dataType: "json",
		data: {
			'phone':$('#log_phone').val(),
			'password':$('#log_password').val()
		},
		success: function(response) {
			console.log(response);
			if (response.status=="done") {
				window.localStorage.setItem("login", 'w');
				window.localStorage.setItem("token", response.data.token);
				isLogin();
				myalert("Вход выполнен успешно");
			} else {
				alertError(response.errorcode);
			}
		},
		error: function(request, status, err) {
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
	$('#loading').hide();
}

function myalert (text) {
	var notification = document.querySelector('.mdl-js-snackbar');
	notification.MaterialSnackbar.showSnackbar(
		{
			message: text
		}
	);
}

function find_work() {
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/worker.findWork",
		dataType: "html",
		data: {
			'token':window.localStorage.getItem("token")
		},
		success: function(response) {
			$('#worker_content_all').html(response);
		},
		error: function(request, status, err) {
			myalert ("Превышено время ожидания ответа от сервера");
			console.error(request+" "+status+" "+err);
		}
	});
	$('#loading').hide();
}

function check_on (ticket_id) {
	$.post('https://easywork.su/php/check_on.php',	 {	'token':window.localStorage.getItem("token"),'ticket_id':ticket_id },
		function(data) {
			myalert(data);
		});
}

function find_answers() {
	$.ajax({
		type: "POST",
		url: "http://easywork.su/php/find_answers.php",
		dataType: "html",
		data: { 'token':window.localStorage.getItem("token") },
		success: function(data) {
			$("#new_answers").html(data);
		},
		error: function(request, status, err) {
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
}


function find_deal_w () {
	$('#loading').toggle();
	$.post('https://easywork.su/php/find_deal_w.php',	 {	'token': window.localStorage.getItem("token"), },

		function(data) {
			$('#loading').toggle();
			$("#deal_w").html(data);
		});
}

function accept_deal_w (deal_id) {
	$('#loading').toggle();
	$.post('https://easywork.su/php/accept_deal_w.php',	 {	'token': window.localStorage.getItem("token"),
			'deal_id': deal_id },

		function(data) {
			$('#loading').toggle();
			myalert(data);
		});
}
