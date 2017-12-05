<?php 
require_once('functions.php');

$id = $_POST['id'];
$stmt = $db -> prepare("DELETE FROM phonebook WHERE id = ?");

if($stmt -> execute(array($id))) {
	$result = array();
	$result['Result'] = 'OK';
	echo json_encode($result);
} else {
	echo json_encode(getRecords("Записей не была удалена"));
}
?>