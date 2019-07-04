<?php
//Пропускаем только авторизованного пользователя
require_once"function.php";
checkLogin(user_id);

//Получение данных из $_POST и $_FILES
$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['image'];
$id = $_GET['id'];


//Проверка данных на пустоту
require_once"function.php";
checkData($_POST);


//Картинка не загружена
if($image['error'] === 4) {
	$errorMessage = 'Загрузите картинку';
	include 'errors.php';
    exit;	
}

//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку если есть
if(file_exists('uploads/' . $task['image'])) {
        unlink('uploads/' . $task['image']);
}

//загрузка картинки в папку uploads
require_once"function.php";
loadPicture($image);



//Подготовка и выполнение запроса к БД
$sql = "UPDATE tasks SET title=:title, description=:description, image=:image WHERE id=:id";
$statement = $pdo->prepare($sql);
$task = $statement->execute([
	":title"	=>	$title,
	":description"	=>	$description,
	":image"	=>	$image['name'],
	":id"	=>	$id,
          ]);


header('Location: /index.php');
