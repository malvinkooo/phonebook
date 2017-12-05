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
	$('.phone-table').jtable({
		title: 'Телефонная книга',
		actions: {
			listAction: function(getData, jtParams){
            return $.Deferred(function($dfd){
               $.ajax({
                  url: 'api/phonebook',
                  type: 'GET',
                  dataType: 'json',
                  data: getData,
                  success: function(data){
                     $dfd.resolve(data);
                  },
                  error: function() {
                     $dfd.reject();
                  }
               });
            });
         },
			createAction: function(postData, jtParams){
            return $.Deferred(function($dfd){
               $.ajax({
                  url: 'api/phonebook',
                  type: 'POST',
                  dataType: 'json',
                  data: postData,
                  seccess: function(data){
                     $dfd.resolve(data);
                     console.log('=)');
                  },
                  error: function(){
                     $dfd.reject();
                     console.log('=(');
                  }
               });
            });
         },
			updateAction: '/phonebook/updateAction.php',
			deleteAction: '/phonebook/deleteAction.php'
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
            title: 'Дата рождения',
            width: '10%'
         },
         comment: {
         	title: 'Комментарий',
         	type: 'textarea',
         	width: '10%'
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