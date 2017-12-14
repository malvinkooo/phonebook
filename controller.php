<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';
require 'functions.php';

$app = new \Slim\App();

$app->get('/api/phonebook', function (Request $request, Response $response) {
    global $db;
    $response = $response->withHeader('Content-type', 'application/json');

    $stm = $db->prepare("SELECT * FROM phonebook");

    if (($stm->execute())) {
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);

        $response->getBody()->write(json_encode(getRecords($data, true)));
    } else {
        $response->getBody()->write(json_encode(writeError("Записей не найдено")));
    }
    return $response;
});

$app->post('/api/phonebook', function (Request $request, Response $response) {
    global $db;
    $response = $response->withHeader('Content-type', 'application/json');
    $sendData = $db->prepare("INSERT INTO `phonebook` (`name`, `surname`, `patronymic`, `mainphone`, `workphone`, `birthday`, `comment`) VALUES (:name, :surname, :patronymic, :mainphone, :workphone, :birthday, :comment)");

    $postParams = $request->getParsedBody();

    if( empty($postParams['birthday']) ) {
        $postParams['birthday'] = NULL;
    }
    $params = array(
        ':name' => $postParams['name'],
        ':surname' => $postParams['surname'],
        ':patronymic' => $postParams['patronymic'],
        ':mainphone' => $postParams['mainphone'],
        ':workphone' => $postParams['workphone'],
        ':birthday' => $postParams['birthday'],
        ':comment' => $postParams['comment'],
    );

    if ($sendData->execute($params)) {
        global $db;
        $lastid = $db->lastInsertId();

        $getData = $db->prepare("SELECT * FROM phonebook WHERE id = ?");

        if ($getData->execute(array($lastid))) {
            $data = $getData->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($data)) {
                $response->getBody()->write(json_encode(getRecords($data[0], false)));
            } else {
                $response->getBody()->write(json_encode(writeError("Запись не найдена")));
            }
        } else {
            $response->getBody()->write(json_encode(writeError("Запрос прошел неудачно")));
        }
    } else {
        $response->getBody()->write(json_encode(writeError("Запись не была добавлена")));
    }
    return $response;
});

$app->delete('/api/phonebook/{id}', function (Request $request, Response $response, $args) {
    global $db;
    $response = $response->withHeader('Content-type', 'application/json');

    $stmt = $db->prepare("DELETE FROM phonebook WHERE id = ?");

    $id = $args['id'];
    if($stmt->execute(array($id))) {
        $result = array();
        $result['Result'] = 'OK';
        $response->getBody()->write(json_encode($result));
    } else {
        $response->getBody()->write(json_encode(writeError("Записи не были удалены")));
    }
    return $response;
});

$app->put('/api/phonebook/{id}', function(Request $request, Response $response, $args){
    global $db;

    $sendData = $db -> prepare("UPDATE `phonebook`
        SET `name` = :name,
        `surname` = :surname,
        `patronymic` = :patronymic,
        `mainphone` = :mainphone,
        `workphone` = :workphone,
        `birthday` = :birthday,
        `comment` = :comment
            WHERE id = :id");

    $postParams = $request->getParsedBody();
    $params = array(
        'id' => $args['id'],
        ':name' => $postParams['name'],
        ':surname' => $postParams['surname'],
        ':patronymic' => $postParams['patronymic'],
        ':mainphone' => $postParams['mainphone'],
        ':workphone' => $postParams['workphone'],
        ':birthday' => $postParams['birthday'],
        ':comment' => $postParams['comment'],
    );
    if($sendData -> execute($params)) {

        $getData = $db -> prepare("SELECT * FROM phonebook WHERE id = ?");

        if($getData -> execute(array($args['id']))) {
            $data = $getData -> fetchAll(PDO::FETCH_ASSOC);
            if(!empty($data)) {
                $response->getBody()->write(json_encode(getRecords($data[0], false)));
            } else {
                $response->getBody()->write(json_encode(getRecords("Запись не найдена")));
            }
        } else {
            $response->getBody()->write(json_encode(writeError("Запрос прошел неудачно")));
        }
    } else {
        $response->getBody()->write(json_encode(writeError("Запись не была обновлена")));
    }
    return $response;
});

$app->run();
