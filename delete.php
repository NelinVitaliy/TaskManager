<?php
//Пропускаем авторизованного пользователя
session_start();

if(!isset($_SESSION['user_id'])) { 
	header('Location: /index.php');
	exit;
}

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
if(file_exists('uploads/' . $task['image'])) {
	    unlink('uploads/' . $task['image']);
}


//Подготовка и выполнение запроса к БД
$sql = 'DELETE from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);

exit;
