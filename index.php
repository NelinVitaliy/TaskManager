<?php
session_start();

if(!isset($_SESSION['user_id'])) { 
    header('Location: /login-form.php');
    exit;
}

//подготовка и выполнение запроса к БД
$pdo = new PDO('mysql:host=localhost;dbname=task_manager', 'root', '');
$sql = 'SELECT * from tasks where user_id=:user_id';
$statement = $pdo->prepare($sql);
$statement->execute([
            ':user_id' =>  $_SESSION['user_id']
          ]
);
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Tasks</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About Task Manager</h4>
              <p class="text-muted">Task Manager is my first project, done by myself.<br>On the link below you will find my contact details.</p><p class="text-muted">Have a nice day👋</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">nelin@example.com</h4>
              <ul class="list-unstyled">
                <li><a href="\logout.php" class="text-white">Exit</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
           <img class="mb-4" src="assets/img/aperture.png" alt="" width="32" height="32">
            <strong>Task Manager</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Task Manager</h1>
          <p class="lead text-muted">Welcome to My Task Manager👋</p><p class="lead text-muted">Let’s get you started right now!</p>
          <p>
            <a href="create-form.php" class="btn btn-primary my-2">Add a task</a>
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
           <div class="row">

            <?php foreach($tasks as $task):;?>
             <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="uploads/<?php echo $task['image'];?>">
                <div class="card-body">
                  <p class="card-text"><?php echo $task['title'];?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="/show.php?id=<?php echo $task['id'];?>" class="btn btn-sm btn-outline-secondary">Show</a>
                      <a href="/edit-form.php?id=<?php echo $task['id'];?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                      <a href="/delete.php?id=<?php echo $task['id'];?>" class="btn btn-sm btn-outline-secondary" onclick="confirm('are you sure?')">Delete</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Up</a>
        </p>
      <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </body>
 </html> 