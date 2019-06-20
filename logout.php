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
//Удаляем данные из сессии
unset($_SESSION['user_id']);
unset($_SESSION['email']);


//Переадрисовываем на страницу login-form
header('Location: /login-form.php');

=======
//удаляем данные из сессии
unset($_SESSION['user_id']);
unset($_SESSION['email']);

header('Location: /login-form.php');
>>>>>>> cd5dcb210bf0507c1111c8657c8498be51ef4322
exit;