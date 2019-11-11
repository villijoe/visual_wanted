<?php

$sth = $pdo->prepare('SELECT * FROM catalog');
$sth->execute();
$catalogs = $sth->fetchAll(PDO::FETCH_ASSOC);