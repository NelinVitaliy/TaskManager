<?php
//Проверка авторизованного пользователя
require_once"function.php";
checkLogin(user_id);

//Получение ID
$id = $_GET['id'];


//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);
$tasks = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку, если есть
if(file_exists('/uploads/' . $task['image'])) {
	    unlink('/uploads/' . $task['image']);
}


//Подготовка и выполнение запроса к БД
$sql = 'DELETE from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);


header('Location: /index.php');
exit;
