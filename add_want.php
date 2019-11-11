<?php

require_once('conn_db.php');

$name = $_POST['name'];
$description = $_POST['description'];
$img = $_POST['img'];
$price = $_POST['price'];
$link = $_POST['link'];
$catalog = $_POST['catalog'];

$sql = "INSERT INTO wants(`name`, `catalog_id`, `description`, `img`, `price`, `link`) VALUES(?, ?, ?, ?, ?, ?)";
$sth = $pdo->prepare($sql);
$sth->execute(array($name, $catalog, $description, $img, $price, $link));

print_r(array($name, $catalog, $description, $img, $price, $link));