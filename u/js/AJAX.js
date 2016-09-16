function sendUserRegister() {
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/client.register",
		dataType: "json",
		data: {
			'name': $('#user_name').val(),
			'surname': $('#user_surname').val(),
			'phone': $('#user_phone').val(),
			'password': $('#user_password').val(),
			'email': $('#user_email').val()
		},
		success: function(response) {
			console.log(response);
			$('#loading').hide();
			if (response.status == "error") {
				alertError(response.errorcode);
			} else {
				alertDone(response.data.code);
				$("#log-menu").toggle();
				$("#reg-menu").toggle();
			}
		},
		error: function(request, status, err) {
			$('#loading').hide();
			myalert("Не получен ответ от сервера");
		}
	});
}

function send_user_login() {
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/client.login",
		dataType: "json",
		data: {
			'phone': $('#log_phone').val(),
			'password': $('#log_password').val()
		},
		success: function(response) {
			$('#loading').hide();
			if (response.status == "done") {
				window.localStorage.setItem("login", 'c');
				window.localStorage.setItem("token", response.data.token);
				isLogin();
				myalert("Вход выполнен успешно");
			} else {
				alertError(response.errorcode);
			}
		},
		error: function(request, status, err) {
			$('#loading').hide();
			myalert("Не получен ответ от сервера");
		}
	});
}

function checkLogin() {
	console.log("checkLogin");

	$('#loading').show();
	if (window.localStorage.getItem("token") != null) {
		$.ajax({
			type: "POST",
			url: "http://core.easywork.su/api/client.checkLogin",
			dataType: "json",
			data: {
				'token': window.localStorage.getItem("token")
			},
			success: function(response) {
				console.log(response);
				if (response.status == "done") {
					$("#log-menu").css("display", "none");
					$("#reg-menu").css("display", "none");
					$("#main-menu").css("display", "block");
					//getBadge(); -----------------------------
					//start_badge_up(20000);
				} else {
					window.localStorage.setItem("token", 'bad');
					$("#log-menu").css("display", "block");
					$("#reg-menu").css("display", "none");
					$("#main-menu").css("display", "none");
					end_badge_up();
				}
			},
			error: function(request, status, err) {
				myalert("Не получен ответ от сервера");
			}
		});
	} else {
		$("#log-menu").css("display", "none");
		$("#reg-menu").css("display", "block");
		$("#main-menu").css("display", "none");
	}
	$('#loading').hide();
}



function myalert(text) {
	var notification = document.querySelector('.mdl-js-snackbar');
	notification.MaterialSnackbar.showSnackbar({
		message: text
	});
}

function add_ticket() {
	$('#loading').toggle();
	var job_id = $('input[type=radio][name=category]:checked').val();
	if (job_id != undefined && ticket_date != undefined && callAddress != undefined && callPosition != undefined) {
		$('#loading').show();
		$.ajax({
			type: "POST",
			url: 'http://core.easywork.su/api/client.addTicket',
			dataType: "json",
			data: {
				'job_id': job_id,
				'token': window.localStorage.getItem("token"),
				'date': ticket_date,
				'address': callAddress,
				'coordinates': callPosition
			},
			success: function(response) {
				if (response.status == "error") {
					alertError(response.errorcode);
				} else {
					alertDone(response.data.code);
				}
				$('#loading').hide();
				console.log(response);
			},
			error: function(request, status, err) {
				myalert("Не получен ответ от сервера")
				$('#loading').hide();
			}
		});
	} else {
		myalert("Заполните все поля");
	}
	$('#loading').hide();
}


function find_answers() {
	$('#loading').toggle();
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/client.getAnswers",
		dataType: "html",
		data: {
			'token': window.localStorage.getItem("token")
		},
		success: function(data) {
			$("#new_answers").html(data);
		},
		error: function(request, status, err) {
			myalert("Не получен ответ от сервера");
			console.error(request + " " + status + " " + err);
		}
	});
	$('#loading').hide();
}

function accept_worker(id) {
	$('#loading').toggle();
	$.post('https://easywork.su/php/accept_worker.php', {
			'token': window.localStorage.getItem("token"),
			'id': id
		},
		function(data) {
			$('#loading').toggle();
			find_answers();
			myalert(data);
		});
}

function find_deal_c() {
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "https://easywork.su/php/find_deal_c.php",
		dataType: "html",
		data: {
			'token': window.localStorage.getItem("token")
		},
		success: function(data) {
			$('#loading').hide();
			$("#deal_u").html(data);
		},
		error: function(request, status, err) {
			$('#loading').hide();
			myalert("Не получен ответ от сервера");
		}
	});
}

function accept_deal_c(deal_id) {
	$('#loading').show();
	$.post('https://easywork.su/php/accept_deal_c.php', {
			'token': window.localStorage.getItem("token"),
			'deal_id': deal_id
		},

		function(data) {
			$('#loading').hide();
			myalert(data);
		});
}


function findHistory() {
	$('#history_main').toggle();
	$.post('https://easywork.su/php/find_history_u.php', {
			'token': window.localStorage.getItem("token")
		},
		function(data) {
			$("#history").html(data);
		});
}