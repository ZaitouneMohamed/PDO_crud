<?php

include('functions.php');
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {
    if (isset($_POST['btn'])) {
        $name = $_POST['name'];
        $query = $pdo->prepare('UPDATE `categorie` SET `name`= ? WHERE `id`= ?  ');
        $query->execute([$name , $_GET['id']]);
    
        header('location:categorie.php');
    }
    $stmt = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $categorie = $stmt->fetch(PDO::FETCH_ASSOC);
    // if (!$categorie) {
    //     exit('Contact doesn\'t exist with that ID!');
    // }
}

?>

<?=template_header('Home')?>

<div class="container">
    <h1>Update Categorie</h1>
<form method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Categorie Name</label>
    <input type="text" name="name" class="form-control" value="<?=$categorie['name']?>">
  </div>
  <button type="submit" name="btn" class="btn btn-primary">Submit</button>
</form>
</div>

    
</body>
</html>
<?=template_footer()?>