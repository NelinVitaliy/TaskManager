<?php

//Пропускаем авторизованного пользователя
session_start();

if(!isset($_SESSION['user_id'])) { 
	header('Location: /login-form.php');
	exit;
}

//Удаляем данные из сессии
unset($_SESSION['user_id']);
unset($_SESSION['email']);


//Переадрисовываем на страницу login-form
header('Location: /login-form.php');

exit;