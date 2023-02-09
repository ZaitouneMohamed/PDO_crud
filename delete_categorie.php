<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$stmt = $pdo->prepare('DELETE FROM categorie WHERE id = ?');
$stmt->execute([$_GET['id']]);

header('Location: categorie.php');