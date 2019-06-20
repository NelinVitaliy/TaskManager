<?php
session_start();

if(!isset($_SESSION['user_id'])) { 
	header('Location: /index.php');
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
$tasks = $statement->fetch(PDO::FETCH_ASSOC);

//Удаляем текущую картинку если есть
if(file_exists('uploads/' . $task['image'])) {
        unlink('uploads/' . $task['image']);
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
