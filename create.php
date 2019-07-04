<?php
//Проверка авторизованного пользователя
require_once"function.php";
checkLogin(user_id);

//Данные из $_POST и $_FILES
 $title = $_POST['title'];
 $description = $_POST['description'];
 $image = $_FILES['image'];

//Проверка данных на пустоту
require_once"function.php";
checkData($_POST);

//Картинка не загружена
if($image['error'] == 4) {
    $errorMessage = 'Загрузите картинку';
         include 'errors.php';
         exit;
 }

//загрузка картинки в папку uploads
require_once"function.php";
loadPicture($image);


 //Подготовка и выполнение запроса к БД
 $pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
 $sql = "INSERT INTO tasks (title, description, image, user_id) VALUES (:title, :description, :image, :user_id)";
 $statement = $pdo->prepare($sql);
 $tasks  = $statement -> execute ([
                  ":title" => $title,
            ":description" => $description,
                  ":image" => $image['name'],
                ":user_id" => $_SESSION['user_id']
                            ]
 );

 header('Location: /index.php');