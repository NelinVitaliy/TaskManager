<?php

<<<<<<< HEAD
//Пропускаем авторизованного пользователя
=======
//пропускаем только авторизованного пользователя
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
session_start();

if(!isset($_SESSION['user_id'])) { 
	header('Location: /login-form.php');
	exit;
}

<<<<<<< HEAD
//Получение ID
$id = $_GET['id'];

//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
=======
//получение id записи
$id = $_GET['id'];

//подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'homestead', 'secret');
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);
<<<<<<< HEAD
$tasks = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку, если есть
if(file_exists('uploads/' . $task['image'])) {
	    unlink('uploads/' . $task['image']);
}


//Подготовка и выполнение запроса к БД
=======
$task = $statement->fetch(PDO::FETCH_ASSOC);

//удаляем текущую картинку если существует
if(file_exists('uploads/' . $task['image'])) {
	unlink('uploads/' . $task['image']);
}


//подготовка и выполнение запроса к БД
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
$sql = 'DELETE from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
	':id'	=>	$id,
]);

<<<<<<< HEAD
=======

header('Location: /index.php');
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
exit;