<?php

include('functions.php');
$pdo = pdo_connect_mysql();

if (isset($_GET['id'])) {

  
    
    $stmt = $pdo->prepare('SELECT * FROM article WHERE id = ?');
    $stmt->execute([$_GET['id'] ]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article['user_id'] != $_SESSION['user_id'] ) {
      header('location:articles.php');
    };

    if (isset($_POST['btn'])) {
        
        // image here
        
        $old_image = $article['image'];
        $folder = "images/";
        unlink($folder.$old_image);
        // 


        $new_image = $_FILES["image"]["name"];
        $tmpname = $_FILES["image"]["tmp_name"];
        $place = "images/";
        move_uploaded_file($tmpname, $place . $new_image);
        $id = $_GET['id'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $query = $pdo->prepare("UPDATE `article` SET `titre`= '$titre' , `image`= '$new_image' , `description`= '$description' , `categorie_id`= '$categorie' WHERE `id`= ? ");
        $query->execute([$id]);
    
        header('location:articles.php');
    }
    // if (!$categorie) {
    //     exit('Contact doesn\'t exist with that ID!');
    // }
}

?>

<?=template_header('Home')?>

<div class="container">
    <h1>Update Article</h1>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">article titre :</label>
    <input type="text" name="titre" class="form-control" value="<?=$article['titre']?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">image :</label>
    <input type="file" name="image" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">article desciprion :</label>
    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?=$article['description']?></textarea>
  </div>
  <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Categorie Name</label>
            <select class="form-select" name="categorie" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <?php foreach ($categories as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
  <button type="submit" name="btn" class="btn btn-primary">Submit</button>
</form>
</div>

    
</body>
</html>
<?=template_footer()?>