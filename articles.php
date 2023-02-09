<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT a.* , c.name FROM article a join categorie c on a.categorie_id = c.id');
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<?=template_header('articles');?>

<div class="container">
  <br>
	<h2>Articles</h2><br>
    <a href="add_article.php" class="btn btn-primary">Add Article</a><br><br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titre</th>
      <th scope="col">image</th>
      <th scope="col">description</th>
      <th scope="col">categorie</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach($articles as $item): ?>
        <tr>
        <th scope="row"><?= $item['id'] ?></th>
        <th><?= $item['titre'] ?></th>
        <th><img src="./images/<?= $item['image'] ?>" width="50px" height="50px" style="border-radius:50% ;" alt=""></th>
        <th><?= $item['description'] ?></th>
        <th><?= $item['name'] ?></th>
        <th>
            <a href="update_categorie.php?id=<?= $item['id'] ?>" class="btn btn-warning">update</a>
            <a href="delete_article.php?id=<?= $item['id'] ?>" class="btn btn-danger">delete</a>
        </th>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>

    
</body>
</html>
<?=template_footer()?>