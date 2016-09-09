function send_user_register() {
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "http://core.easywork.su/api/client.register",
		dataType: "json",
		data: {
			'name':$('#user_name').val(),
			'surname':$('#user_surname').val(),
			'phone':$('#user_phone').val(),
			'password':$('#user_password').val(),
			'email':$('#user_email').val()
		},
		success: function(response) {
			console.log(response);
			$('#loading').hide();
			if (response.status=="error"){
				alertError(response.errorcode);
			} else {
				alertDone(response.data.code);
				$("#log-menu").toggle();
				$("#reg-menu").toggle();
			}
		},
		error: function(request, status, err) {
			$('#loading').hide();
			myalert ("Превышено время ожидания ответа от сервера");
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
			'phone':$('#log_phone').val(),
			'password':$('#log_password').val()
		},
		success: function(response) {
			$('#loading').hide();
			if (response.status=="done") {
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
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
}

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

function add_ticket () {
	var job_id = $('input[type=radio][name=category]:checked').val();
	if (job_id != undefined){
		$('#loading').show();
		$.ajax({
			type: "POST",
			url: 'http://core.easywork.su/api/client.addTicket',
			dataType: "json",
			data: {
				'job_id':job_id,
				'token':window.localStorage.getItem("token"),
				'date':ticket_date,
				'address':adr,
				'coordinates':coord
			},
			success: function(response) {
				if (response.status=="error"){
					alertError(response.errorcode);
				} else {
					alertDone(response.data.code);
				}
				$('#loading').hide();
				console.log(response);
			},
			error: function(request, status, err) {
				myalert ("Не получен ответ сервера")
				$('#loading').hide();
			}
		});
	} else {
		myalert("Выберите категорию");
	}
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
		timeout: 1500,
		success: function(data) {
			$("#new_answers").html(data);
		},
		error: function(request, status, err) {
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
}

function accept_worker (id) {
	$('#loading-2').toggle();
	$.post('https://easywork.su/php/accept_worker.php',	 {	'token': window.localStorage.getItem("token"),
			'id': id},
		function(data) {
			$('#loading-2').toggle();
			find_answers();
			myalert(data);
		});
}

function find_deal_c () {
	$('#loading-2').show();
	$.ajax({
		type: "POST",
		url: "https://easywork.su/php/find_deal_c.php",
		dataType: "html",
		data: { 'token':window.localStorage.getItem("token") },
		timeout: 10000,
		success: function(data) {
			$('#loading-2').hide();
			$("#deal_u").html(data);
		},
		error: function(request, status, err) {
			$('#loading-2').hide();
			myalert ("Превышено время ожидания ответа от сервера");
		}
	});
}

function accept_deal_c (deal_id) {
	$('#loading-2').show();
	$.post('https://easywork.su/php/accept_deal_c.php',	 {	'token': window.localStorage.getItem("token"),
			'deal_id': deal_id },

		function(data) {
			$('#loading-2').hide();
			myalert(data);
		});
}

function find_deal_w () {
	$('#loading-').toggle();
	$.post('https://easywork.su/php/find_deal_w.php',	 {	'token': window.localStorage.getItem("token"), },

		function(data) {
			$('#loading-').toggle();
			$("#deal_w").html(data);
		});
}

function accept_deal_w (deal_id) {
	$('#loading-').toggle();
	$.post('https://easywork.su/php/accept_deal_w.php',	 {	'token': window.localStorage.getItem("token"),
			'deal_id': deal_id },

		function(data) {
			$('#loading-').toggle();
			myalert(data);
		});
}

function find_history_c() {
	$('#history_main').toggle();
	$.post('https://easywork.su/php/find_history_u.php',	 {	'token': window.localStorage.getItem("token") },
		function(data) {
			$("#history").html(data);
		});
}
/*
function badge_c() {
	var source = new EventSource("https://easywork.su/php/badge.php?token="+get_cookie("who")+"&type=c");
	source.onmessage = function(event) {
		var push_u = JSON.parse(event.data);
		console.log(push_u);
		window.navigator.vibrate(100);
		if (push_u.answers != null && push_u.answers != '0'){
			$('#answers_badge').addClass('mdl-badge');
			$('#answers_badge').attr("data-badge", push_u.answers);
		} else{
			$('#answers_badge').removeClass('mdl-badge');
			$('#answers_badge').attr("data-badge", '');
		}
		if (push_u.deals != null && push_u.deals != '0'){
			$('#deals_badge').addClass('mdl-badge');
			$('#deals_badge').attr("data-badge", push_u.deals);
		} else{
			$('#deals_badge').removeClass('mdl-badge');
			$('#deals_badge').attr("data-badge", '');
		}
	};
}
/*
function badge_u_old() {
	$.post('https://easywork.su/php/badge.php',	 {	'user_id': get_cookie("who"), 'type': 'c' },
		function(data) {
			console.log(data);

			if (data_answers < data.answers){
				window.navigator.vibrate(200);
			}
			data_answers = data.answers;

			if (data.answers != null && data.answers != '0'){
				$('#answers_badge').addClass('mdl-badge');
				$('#answers_badge').attr("data-badge", data.answers);
			} else{
				$('#answers_badge').removeClass('mdl-badge');
				$('#answers_badge').attr("data-badge", '');
			}
			if (data.deals != null && data.deals != '0'){
				$('#deals_badge').addClass('mdl-badge');
				$('#deals_badge').attr("data-badge", data.deals);
			} else{
				$('#deals_badge').removeClass('mdl-badge');
				$('#deals_badge').attr("data-badge", '');
			}
		}, 'json');
}

function badge_w() {
	$.post('https://easywork.su/php/badge.php',	 {	'user_id': get_cookie("who"), 'type': 'w' },
		function(data) {
			console.log(data);
			if (data_deals < data.deals){
				window.navigator.vibrate(200);
			}
			data_deals = data.deals;

			if (data.deals != null && data.deals != '0'){
				$('#deals_badge').addClass('mdl-badge');
				$('#deals_badge').attr("data-badge", data.deals);
			} else{
				$('#deals_badge').removeClass('mdl-badge');
				$('#deals_badge').attr("data-badge", '');
			}
		}, 'json');
}

function badge_u() {
	var source = new EventSource("https://easywork.su/php/sse.php?id="+get_cookie("who"));
	source.onmessage = function(event) {
		var push_u = JSON.parse(event.data);
		console.log(push_u);
		window.navigator.vibrate(100);
		if (push_u.answers != null && push_u.answers != '0'){
			$('#answers_badge').addClass('mdl-badge');
			$('#answers_badge').attr("data-badge", push_u.answers);
		} else{
			$('#answers_badge').removeClass('mdl-badge');
			$('#answers_badge').attr("data-badge", '');
		}
		if (push_u.deals != null && push_u.deals != '0'){
			$('#deals_badge').addClass('mdl-badge');
			$('#deals_badge').attr("data-badge", push_u.deals);
		} else{
			$('#deals_badge').removeClass('mdl-badge');
			$('#deals_badge').attr("data-badge", '');
		}
	};
}
*/
