<?php

include('functions.php');
check();

$pdo = pdo_connect_mysql();

$id = $_SESSION['user_id'];
$profile = $pdo->prepare("select * from users where id = ? ");
$profile->execute([$id]);

$item = $profile->fetch();


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
</div>


</body>

</html>
<?= template_footer() ?>