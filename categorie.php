<?php
include 'functions.php';

$pdo = pdo_connect_mysql();



?>

<?=template_header('Home');?>

<div class="container">
	<h2>Categorie</h2><br>
    <a href="add_categorie.php" class="btn btn-primary">Add Categorie</a><br><br>
	<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach($categories as $item): ?>
        <tr>
        <th scope="row"><?= $item['id'] ?></th>
        <th><?= $item['name'] ?></th>
        <th>
            <a href="update_categorie.php?id=<?= $item['id'] ?>" class="btn btn-warning">update</a>
            <a href="delete_categorie.php?id=<?= $item['id'] ?>" class="btn btn-danger">delete</a>
        </th>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>

    
</body>
</html>
<?=template_footer()?>