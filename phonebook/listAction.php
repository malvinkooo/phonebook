<?php 
require_once('functions.php');

$stm = $db -> prepare("SELECT id, name, surname, patronymic, mainphone, workphone, birthday, comment FROM phonebook");

if(($stm -> execute())) {
	$data = $stm -> fetchAll(PDO::FETCH_ASSOC);
	echo json_encode(getRecords($data));
} else {
	echo json_encode(getRecords("Записей не найдено"));
}
?>