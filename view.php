<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$id = $_GET['id'];

$query = $pdo->prepare('SELECT a.* , c.name , u.username FROM categorie c  join article a on c.id = a.categorie_id join users u on a.user_id = u.id where a.id = ? ');
// $query = $pdo->prepare('select a.* from article a join categorie c on on c.id = a.categorie_id where a.id = ?');
$query->execute([$id]);
$article = $query->fetch(PDO::FETCH_ASSOC);


?>

<?= template_header('view article'); ?>

<div class="container">
  <br>
  <h2 class="text text-center">View Article</h2><br>
  <div class="row" style="margin-left: 35%;">
    <div class="col-3">
      <div class="card" style="width: 18rem;">
        <img src="./images/<?= $article['image'] ?>" width="150px" height="200px" class="card-img-top" alt="...">
        <div class="card-body">
          <center>
            <h5 class="card-title"><?= $article['titre'] ?></h5>
            <p class="text"><?= $article['username'] ?></p>
            <p class="card-text"><?= $article['description'] ?></p>
            <p class="card-text"><?= $article['name'] ?></p>
            <?php
            if (isset($_SESSION['user_id'])) {
              if ($article['user_id'] === $_SESSION['user_id']) {
                $id = $article['id'];
                echo <<<EOT
                    <a href="update_article.php?id=$id" class="btn btn-warning">update</a>
                    <a href="delete_article.php?id=$id" class="btn btn-danger">delete</a> 
                  EOT;;
              };
            };
            ?>
          </center>

        </div>
      </div>
    </div>
  </div>

</div>


</body>

</html>
<?= template_footer() ?>