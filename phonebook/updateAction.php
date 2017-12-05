<?php 
require_once('functions.php');


$sendData = $db -> prepare("UPDATE `phonebook` SET `name` = :name, `surname` = :surname, `patronymic` = :patronymic, `mainphone` = :mainphone, `workphone` = :workphone, `birthday` = :birthday, `comment` = :comment WHERE id = :id");

$params = array(
	':name' => $_POST['name'],
	':surname' => $_POST['surname'],
	':patronymic' => $_POST['patronymic'],
	':mainphone' => $_POST['mainphone'],
	':workphone' => $_POST['workphone'],
	':birthday' => $_POST['birthday'],
	':comment' => $_POST['comment'],
	':id' => $_POST['id']
);
if($sendData -> execute($params)) {
	global $db;

	$getData = $db -> prepare("SELECT id, name, surname, patronymic, mainphone, workphone, birthday, comment FROM phonebook WHERE id = ?");

	if($getData -> execute(array($_POST['id']))) {
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
	echo json_encode(getRecords("Запись не была обновлена"));
}
?>