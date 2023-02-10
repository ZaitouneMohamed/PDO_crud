<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT a.* , c.name FROM article a join categorie c on a.categorie_id = c.id');
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
            <h5 class="card-title"><?= $item['titre'] ?></h5>
            <p class="card-text"><?= $item['description'] ?></p>
            <p class="card-text"><?= $item['name'] ?></p>
            <a href="update_article.php?id=<?= $item['id'] ?>" class="btn btn-warning">update</a>
            <a href="delete_article.php?id=<?= $item['id'] ?>" class="btn btn-danger">delete</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>


</body>

</html>
<?= template_footer() ?>