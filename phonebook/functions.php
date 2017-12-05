<?php 
header("Content-type:application/json");

try {
   $db = new PDO('mysql:host=127.0.0.1;dbname=phonebook', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARSET utf8"));
} catch(PDOException $e) {
	$error = array();
	$error['Result'] = 'ERROR';
	$error['Message'] = "Ошибка: ".$e -> getMessage();
	echo json_encode($error);
	exit();
}
function getRecords($data, $bool) {
	$result = array();
	$result['Result'] = 'OK';

	if($bool) {
		$result['Records'] = $data;
	} else {
		$result['Record'] = $data;
	}
	return $result;
}
function writeError($data) {
	$result = array();
	$result['Result'] = 'ERROR';
	$result['Message'] = $data;
	return $result;
}
?>