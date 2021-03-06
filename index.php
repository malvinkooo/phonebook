<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Phonebook</title>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link href="jtable/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="jtable/jquery.jtable.min.js" type="text/javascript"></script>
	<script src="jtable/localization/jquery.jtable.ru.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			var currentRecordId;
			$('.phone-table').jtable({
				title: 'Телефонная книга',
				actions: {
					listAction: function(getData, jtParams){
						return $.Deferred(function($dfd) {
							var xhr = new XMLHttpRequest();
							xhr.open('GET', 'api/phonebook', true);
							xhr.onreadystatechange = function() {
								if(xhr.readyState === XMLHttpRequest.DONE) {
									if (xhr.status === 200) {
										$dfd.resolve(JSON.parse(xhr.responseText));
									} else {
										$dfd.reject();
									}
								}
							}
							xhr.send();
						});
					},
					createAction: function(postData, jtParams){
						return $.Deferred(function($dfd) {
							var xhr = new XMLHttpRequest();
							xhr.open('POST', 'api/phonebook', true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if(xhr.readyState === XMLHttpRequest.DONE) {
									if (xhr.status === 200) {
										$dfd.resolve(JSON.parse(xhr.responseText));
									} else {
										$dfd.reject();
									}
								}
							}
							xhr.send(postData);
						});
					},
					updateAction: function(postData, jtParams){
						return $.Deferred(function($dfd){
							var xhr = new XMLHttpRequest();
							var url = 'api/phonebook/' + currentRecordId;
							xhr.open('PUT', url, true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function() {
								if(xhr.readyState === XMLHttpRequest.DONE) {
									if (xhr.status === 200) {
										$dfd.resolve(JSON.parse(xhr.responseText));
									} else {
										$dfd.reject();
									}
								}
							}
							xhr.send(postData);
						});
					},
					deleteAction: function(postData, jtParams){
						return $.Deferred(function($dfd){
							var xhr = new XMLHttpRequest();
							var url = 'api/phonebook/' + postData['id'];
							xhr.open('DELETE', url, true);
							xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
							xhr.onreadystatechange = function(){
								if(xhr.readyState === XMLHttpRequest.DONE){
									if(xhr.status === 200) {
										$dfd.resolve(JSON.parse(xhr.responseText));
									} else {
										$dfd.reject();
									}
								}
							}
							xhr.send(postData);
						});
					}
				},
				fields: {
					id: {
						key: true,
						list: false
					},
					name: {
						title: 'Имя',
						width: '6%'
					},
					surname: {
						title: 'Фамилия',
						width: '9%'
					},
					patronymic: {
						title: 'Отчество',
						width: '9%'
					},
					mainphone: {
						title: 'Основной номер',
						width: '18%'
					},
					workphone: {
						title: 'Рабочий номер',
						width: '18%'
					},
					birthday: {
						type: 'date',
						title: 'Дата рождения',
						width: '10%'
					},
					comment: {
						title: 'Комментарий',
						type: 'textarea',
						width: '10%'
					}
				},
				formSubmitting: function(event, data) {
					currentRecordId = $(data.row).attr('data-record-key');
					var name = data.form.find('input[name="name"]')[0].value;
					var mainphone = data.form.find('input[name="mainphone"]')[0].value;
					if( !(name.length && mainphone.length) ) {
						alert('Вы заполнили не все обязательные поля!');
						return false;
					}
				}
			});
			$('.phone-table').jtable('load');
		});
	</script>
</head>
<body>
	<div class="phone-table"></div>
</body>
</html>
