<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
require '../vendor/autoload.php';
require 'functions.php';

$app = new \Slim\App();

$app->get('/api/phonebook', function (Request $request, Response $response) {
    global $db;
    $response = $response->withHeader('Content-type', 'application/json');

    $stm = $db->prepare("SELECT id, name, surname, patronymic, mainphone, workphone, birthday, comment FROM phonebook");

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

        $getData = $db->prepare("SELECT id, name, surname, patronymic, mainphone, workphone, birthday, comment FROM phonebook WHERE id = ?");

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

$app->run();
