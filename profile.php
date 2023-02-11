<?php

include('functions.php');
check();

$pdo = pdo_connect_mysql();

$id = $_SESSION['user_id'];
$profile = $pdo->prepare("select * from users where id = ? ");
$profile->execute([$id]);

$item = $profile->fetch();


$query = $pdo->prepare("select * from article where user_id = ? ");
$query->execute([$id]);

$articles = $query->fetchAll();


?>

<?= template_header('Home') ?>

<br>
<h2 class="text text-center">Profile</h2>
<div class="container">
    <div class="d-flex justify-content-center" >
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?= $item['username'] ?></h5>
            <p class="card-text"><?= $item['email'] ?></p>
            <div class="d-flex">
                <a href="#" class="btn btn-primary">update profile</a>
                <a href="#" class="btn btn-danger">Delete Account</a>
            </div>
        </div>
    </div>
    </div>
    <h2 class="text text-center">My Articles</h2>
    <div class="row">
    <?php foreach ($articles as $article) : ?>
      <div class="col-4 mb-5">
        <div class="card" style="width: 18rem;">
          <img src="./images/<?= $article['image'] ?>" width="150px" height="200px" class="card-img-top" alt="...">
          <div class="card-body">
            <center>
              <h5 class="card-title"><?= $article['titre'] ?></h5>
              <p class="text"><?= $_SESSION['user_username'] ?></p>
              <p class="card-text"><?= $article['description'] ?></p>
              <p class="card-text"><?= timeago($article['created_at']) ?></p>
              <?php 
                if (isset($_SESSION['user_id'])) {
                  if ($article['user_id'] === $_SESSION['user_id'] ) {
                    $id = $article['id'];
                    echo <<<EOT
                      <a href="update_article.php?id=$id" class="btn btn-warning">update</a>
                      <a href="delete_article.php?id=$id" class="btn btn-danger">delete</a> 
                    EOT;;
                  };
                }
              ?>
              <a href="view.php?id=<?= $article['id'] ?>" class="btn btn-success">view</a> 
            </center>
            
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


</body>

</html>
<?= template_footer() ?>