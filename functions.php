<?php
session_start();
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'pdo_crud';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}


$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT * FROM categorie');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

function check() {
  if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
  }
}


function template_header($title) {
  
  //  $username = $_SESSION['user_username'];
    echo <<<EOT
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="articles.php">Articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categorie.php">Categories</a>
        </li>
EOT;
  if (isset($_SESSION["user_username"])) {
    echo <<<EOT
     <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            hfguhe
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">log out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
EOT;
  }else {
        echo <<<EOT
     <li class="nav-item">
          <a class="btn btn-success" href="login.php">login</a>
          <a class="btn btn-warning" href="register.php">register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
EOT;
  }
}

function template_footer() {
    echo <<<EOT
        </body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </html>
    EOT;
    }
    

    
function timeago($date) {
  $timestamp = strtotime($date);	
  
  $strTime = array("second", "minute", "hour", "day", "month", "year");
  $length = array("60","60","24","30","12","10");

  $currentTime = time();
  if($currentTime >= $timestamp) {
   $diff     = time()- $timestamp;
   for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
   $diff = $diff / $length[$i];
   }

   $diff = round($diff);
   return $diff . " " . $strTime[$i] . " ago ";
  }
}