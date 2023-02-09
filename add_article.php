<?php

include('functions.php');
$pdo = pdo_connect_mysql();

$query = $pdo->prepare('SELECT * FROM categorie');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btn'])) {
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    // image here
    $image = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $place = "images/";
    move_uploaded_file($tmpname, $place . $image);
    // 
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';

    $query = $pdo->prepare('INSERT INTO `article`(`titre`, `image`, `description`, `categorie_id`) VALUES (?,?,?,?)');
    $query->execute([$titre,$image,$description,$categorie]);

    header('location:articles.php');
}

?>

<?= template_header('Add New Article') ?>

<div class="container">
    <h1>Add New Categorie</h1>
    <form method="post" enctype="multipart/form-data" >
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">titre :</label>
            <input type="text" name="titre" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">image :</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
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
<?= template_footer() ?>