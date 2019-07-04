<?php
//Проверка данных из $_POST
$email = $_POST['email'];
$password = $_POST['password'];


//Проверка данных на пустоту
require_once"function.php";
checkData($_POST);

//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT id,username,email from users where email=:email AND password=:password';
$statement = $pdo->prepare($sql);
$statement->execute([
 ':email' => $email,
 ':password' => md5($password)
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

//Пользователь не найден
if(!$user) {
    $errorMessage = 'Неверный логин или пароль'; 
    include 'errors.php';
    exit;
}

//Пользователь найден, записываем нужные данные в сессию
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];

//переадресовываем на главную
header('Location: /index.php');
exit;