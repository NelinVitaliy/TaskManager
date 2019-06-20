<?php
session_start();

if(!isset($_SESSION['user_id'])) { 
<<<<<<< HEAD
	header('Location: /index.php');
=======
	header('Location: /login-form.php');
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
	exit;
}

//Получение данных из $_POST и $_FILES
$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['image'];
$id = $_GET['id'];

//Проверка данных
foreach($_POST as $input) {
    if(empty($input)) {
        include 'errors.php';
        exit;
    }
}
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
<<<<<<< HEAD
$tasks = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку если есть
if(file_exists('uploads/' . $task['image'])) {
        unlink('uploads/' . $task['image']);
=======
$task = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку если есть
if(file_exists('uploads/' . $task['image'])) {
	unlink('uploads/' . $task['image']);
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
}

//Загрузка картинки в папку uploads
move_uploaded_file($image['tmp_name'], 'uploads/' . $image['name']);

//Подготовка и выполнение запроса к БД
$sql = "UPDATE tasks SET title=:title, description=:description, image=:image WHERE id=:id";
$statement = $pdo->prepare($sql);
$tasks = $statement->execute([
	":title"	=>	$title,
	":description"	=>	$description,
	":image"	=>	$image['name'],
	":id"	=>	$id
]);
<<<<<<< HEAD
=======

header('Location: /index.php');

>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
