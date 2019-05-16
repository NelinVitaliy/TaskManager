<?php
//Данные из $_POST
$user = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];



//проверка данных 
foreach($_POST as $input) {
	if(empty($input)) {
		include 'errors.php';
		exit;
	}
}
 


//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task-manager','root','');
$sql = "SELECT id from users where email=:email";
$statement = $pdo->prepare($sql);
$statement->execute([":email" => $email]);
$user = $statement->fetchColumn();
if($user) {
	$errorMessage = "Данный email уже используется";
	include "errors.php";
	exit;
}



//Сохранение в БД
$sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
$statement = $pdo->prepare($sql);
//Hash password
$_POST["password"] = md5($_POST["password"]);
$result = $statement->execute($_POST);
if(!$result) {
	$errorMessage = "Ошибка при регистрации. Проверьте ваши данные";
	include "errors.php";
	exit;
}

//Переадресация на login-form.php (авторизацию)
header("Location:\login-form.php"); exit;
