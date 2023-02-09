<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$query = $pdo->prepare('select * from article where id = ?');
$query->execute([$_GET['id']]);
$rslt = $query->fetch(PDO::FETCH_ASSOC);

$image = $rslt['image'];
$folder = "images/";
unlink($folder . $image);

$stmt = $pdo->prepare('DELETE FROM article WHERE id = ?');
$stmt->execute([$_GET['id']]);

header('Location: articles.php');