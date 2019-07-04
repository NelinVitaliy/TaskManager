<?php
//Пропускаем авторизованного пользователя
require_once"function.php";
checkLogin(user_id);

//Удаляем данные из сессии
unset($_SESSION['user_id']);
unset($_SESSION['email']);


//Переадрисовываем на страницу login-form
header('Location: /login-form.php');

exit;