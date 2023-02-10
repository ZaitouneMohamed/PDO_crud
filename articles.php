<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT a.* , c.name ,u.username FROM categorie c  join article a on c.id = a.categorie_id join users u on a.user_id = u.id ORDER BY id DESC  ');
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<?= template_header('articles'); ?>

<div class="container">
  <br>
  <h2 class="text text-center">Articles</h2><br>
  <a href="add_article.php" class="btn btn-primary">Add Article</a><br><br>
  <div class="row">
    <?php foreach ($articles as $item) : ?>
      <div class="col-4">
        <div class="card" style="width: 18rem;">
          <img src="./images/<?= $item['image'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title"><?= $item['titre'] ?>- 
            <?php 
              if ($item['user_id'] === $_SESSION['user_id'] ) {
                echo '<small>by mee</small>';
              };
            ?>
            </h5>
            
                   


          </h5>
            <p class="card-text"><?= $item['description'] ?></p>
            <p class="card-text"><?= $item['name'] ?></p>
            <?php 
              if ($item['user_id'] === $_SESSION['user_id'] ) {
                $id = $item['id'];
                echo <<<EOT
                  <a href="update_article.php?id=$id" class="btn btn-warning">update</a>
                  <a href="delete_article.php?id=$id" class="btn btn-danger">delete</a> 
                EOT;;
              };
            ?>
            
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>


</body>

</html>
<?= template_footer() ?>