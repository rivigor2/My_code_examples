<?php
// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных
include_once '../config/database.php';

// создание объекта товара
include_once '../objects/comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

// получаем отправленные данные
$data = json_decode(file_get_contents("php://input"));

// убеждаемся, что данные не пусты // сюдаже и валидация идет - не успел.
if (
    !empty($data->title)     &&
    !empty($data->comment)   &&
    !empty($data->user_name) &&
    !empty($data->email)
)   {
        // устанавливаем значения свойств товара
        $comment->title     = $data->title;
        $comment->comment   = $data->comment;
        $comment->user_name = $data->user_name;
        $comment->email     = $data->email;
        $comment->created   = date('Y-m-d H:i:s');

        // создание комментария
        if($comment->create()) {

            // установим код ответа - 201 создано
            http_response_code(201);

            // сообщим пользователю
            echo json_encode(array("message" => "Комментарий был создан."), JSON_UNESCAPED_UNICODE);
        }

        // если не удается создать комментарий, сообщим об этом
        else {

            // установим код ответа - 503 сервис недоступен
            http_response_code(503);

            // сообщим пользователю
            echo json_encode(array("message" => "Невозможно создать комментарий."), JSON_UNESCAPED_UNICODE);
        }

    } else { // сообщим пользователю что данные неполные

    // установим код ответа - 400 неверный запрос
    http_response_code(400);

    // сообщим об этом
    echo json_encode(array("message" => "Невозможно создать комментарий. Данные неполные."), JSON_UNESCAPED_UNICODE);
}