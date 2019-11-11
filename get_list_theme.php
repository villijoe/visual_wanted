<?php
require_once('conn_db.php');

$catalog_id = $_POST['catalogId'];

$array = [];
$sql = "SELECT * FROM wants WHERE `catalog_id` = " . $catalog_id;
$sth = $pdo->prepare($sql);
$sth->execute();
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($array);
echo $json;