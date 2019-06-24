<?php
session_start();

if(!isset($_SESSION['user_id'])) { 
    header('Location: /login-form.php');
    exit;
}

 $id = $_GET['id'];

//подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT * from tasks where id=:id';
$statement = $pdo->prepare($sql);
$statement->execute([
          ':id'  =>  $id,
            ]);
$tasks = $statement->fetch(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Show</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
      
    </style>
  </head>

  <body>
    <div class="form-wrapper text-center">
      <img src="<?php echo $task['image'];?>" alt="" width="500">
      <h2><?php echo $task['title'];?></h2>
      <p>
        <?php echo $task['description'];?>
      </p>
    </div>
  </body>
</html>
