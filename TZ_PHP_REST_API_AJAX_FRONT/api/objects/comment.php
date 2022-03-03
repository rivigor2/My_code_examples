<?php
class Comment {

    // подключение к базе данных и таблице 'comments'
    private $conn;
    private $table_name = "comments";

    // свойства объекта
    public $id;
    public $title;
    public $comment;
    public $user_name;
    public $email;
    public $created;

    // конструктор для соединения с базой данных
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){

        // выбираем все записи
        $query = "SELECT title, comment, user_name, email, created FROM " . $this->table_name . " ORDER BY created DESC";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

    // метод create - создание товаров
    public function create(){

        // запрос для вставки записи
        $query = "INSERT INTO " . $this->table_name . " SET title=:title, comment=:comment, user_name=:user_name, email=:email, created=:created";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->title     =htmlspecialchars(strip_tags($this->title));
        $this->comment   =htmlspecialchars(strip_tags($this->comment));
        $this->user_name =htmlspecialchars(strip_tags($this->user_name));
        $this->email     =htmlspecialchars(strip_tags($this->email));
        $this->created   =htmlspecialchars(strip_tags($this->created));

        // привязка значений
        $stmt->bindParam(":title",     $this->title);
        $stmt->bindParam(":comment",   $this->comment);
        $stmt->bindParam(":user_name", $this->user_name);
        $stmt->bindParam(":email",     $this->email);
        $stmt->bindParam(":created",   $this->created);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}