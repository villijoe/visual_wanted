<?php

if ($_POST['theme']) {
    $theme = strtolower($_POST['theme']);
    $sth = $pdo->prepare("INSERT INTO catalog(`name`) VALUES('$theme')");
    //echo $_SESSION['dbname'];
    //print_r($sth);
    $sth->execute();
    header("Location: /");
}