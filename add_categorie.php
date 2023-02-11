<?php

include('functions.php');
$pdo = pdo_connect_mysql();
check();
if (isset($_POST['btn'])) {
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    $query = $pdo->prepare('INSERT INTO categorie (`name`) VALUES (?)');
    $query->execute([$name]);

    header('location:categorie.php');


}

?>

<?=template_header('Home')?>

<div class="container">
    <h1>Add New Categorie</h1>
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Categorie Name</label>
    <input type="text" name="name" class="form-control">
  </div>
  <button type="submit" name="btn" class="btn btn-primary">Submit</button>
</form>
</div>

    
</body>
</html>
<?=template_footer()?>