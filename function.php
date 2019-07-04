<?php
//Проверка авторизованного пользователя
 function checkLogin()
 {
 session_start();
   if(!isset($_SESSION['user_id'])) { 
    header('Location:/login-form.php');
    exit;
}
}

//Проверка данных
function checkData()
{
foreach($_POST as $input) {
    if(empty($input)) {
        include 'errors.php';
        exit;
        }
}
}
//Загрузка картинки в папку uploads
function loadPicture($image)
{
move_uploaded_file($image['tmp_name'], 'uploads/' . $image['name']);
}

