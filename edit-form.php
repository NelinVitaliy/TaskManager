<?php
//Проверка авторизованного пользователя
require_once"function.php";
checkLogin(user_id);


$id = $_GET['id'];

//Подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
  ':id'  =>  $id,
]);
$task = $statement->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Edit Task</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
      
    </style>
  </head>

  <body>
    <div class="form-wrapper text-center">
      <form class="form-signin" method="post" action="edit.php?id=<?php echo $task['id']; ?>" enctype="multipart/form-data">

        <img class="mb-4" src="assets/img/aperture.png" alt="" width="90" height="90">

        <h1 class="h3 mb-3 font-weight-normal">Добавить запись</h1>

        <label for="inputEmail" class="sr-only">Название</label>

        <input type="text" name="title" id="inputEmail" class="form-control" placeholder="Название" required value="<?php echo $task['title'];?>">

        <label for="inputEmail" class="sr-only">Описание</label>
        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Описание"><?php echo $task['description'];?></textarea>

        <input type="file" name="image"> 
        <img src="uploads/<?php echo $task['image'];?>" alt="" width="400" class="mb-3">

        <button class="btn btn-lg btn-success btn-block" type="submit">Редактировать</button>

        <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
      </form>
    </div>
  </body>
</html>  
