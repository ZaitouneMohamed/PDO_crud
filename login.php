<?php
include 'functions.php';

$pdo = pdo_connect_mysql();
if (isset($_POST['btn'])) {
    
    extract($_POST);
    
    $query = $pdo->prepare('SELECT count(*) FROM users where email = ? and password = ? LIMIT 1');
    $pass = md5($password);
    $query->execute([$email,$pass]);
    $data = $query->fetch(PDO::FETCH_ASSOC);
    if ($data['count(*)'] == 1) {
        echo 'all good';
        $query2 = $pdo->prepare('SELECT * FROM users where email = ? and password = ? LIMIT 1');
        $query2->execute([$email,md5($password)]);
        $data2 = $query2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $data2['id'];
        $_SESSION['user_username'] = $data2['username'];
        header('location:index.php');
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form method="post">

            
            <h3 class="mb-5">Sign in</h3>

            <div class="form-outline mb-4">
              <input type="email" id="typeEmailX-2" name="email" placeholder="Email" class="form-control form-control-lg" />
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" name="password" placeholder="Password" class="form-control form-control-lg" />
            </div>

            <button class="btn btn-primary btn-lg btn-block" name="btn">Login</button>

            <hr class="my-4">
            <a href="register.php">or register</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>