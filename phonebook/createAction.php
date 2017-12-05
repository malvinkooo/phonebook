<?php 
require_once('functions.php');

$sendData = $db -> prepare("INSERT INTO `phonebook` (`name`, `surname`, `patronymic`, `mainphone`, `workphone`, `birthday`, `comment`) VALUES (:name, :surname, :patronymic, :mainphone, :workphone, :birthday, :comment)");

$params = array(
	':name' => $_POST['name'],
	':surname' => $_POST['surname'],
	':patronymic' => $_POST['patronymic'],
	':mainphone' => $_POST['mainphone'],
	':workphone' => $_POST['workphone'],
	':birthday' => $_POST['birthday'],
	':comment' => $_POST['comment']
);
if($sendData -> execute($params)){
   global $db;
   $lastid = $db -> lastInsertId();

   $getData = $db -> prepare("SELECT id, name, surname, patronymic, mainphone, workphone, birthday, comment FROM phonebook WHERE id = ?");

   if($getData -> execute(array($lastid))) {
      $data = $getData -> fetchAll(PDO::FETCH_ASSOC);
      if(!empty($data)) {
      	echo json_encode(getRecords($data[0]));
      } else {
      	echo json_encode(getRecords("Запись не найдена"));
      }
   } else {
   	echo json_encode(getRecords("Запрос прошел неудачно"));
   }
} else {
	echo json_encode(getRecords("Запись не была добавлена"));
}
?>