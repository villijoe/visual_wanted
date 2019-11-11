<?php

// declaration const for db connect
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'visualwanted');

// check database and is not find create database and save in session
if (isset($_SESSION['dbname']) && !empty($_SESSION['dbname'])) {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);    
} else {
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    $dbs = $pdo->query('SHOW DATABASES');
    $array_databases = array();
    foreach ($dbs as $db) {
        unset($db['Database']);
        foreach ($db as $item) {
            $array_databases[] = $item;
        }
    }
    //print_r($array_databases);
    if (in_array(DB_NAME, $array_databases)) {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $_SESSION['dbname'] = DB_NAME;
    } else {
        $pdo->exec('CREATE DATABASE ' . DB_NAME);
        $pdo->exec('CREATE TABLE ' . DB_NAME . '.' . 'catalog (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        PRIMARY KEY(`id`)) ENGINE=InnoDB');
        $pdo->exec('CREATE TABLE ' . DB_NAME . '.' . 'wants (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `catalog_id` INT NOT NULL,
        `description` TEXT NOT NULL,
        `img` VARCHAR(255) NOT NULL,
        `price` VARCHAR(255) NOT NULL,
        `link` VARCHAR(255) NOT NULL,
        PRIMARY KEY(`id`)) ENGINE=InnoDB');
        //header("Location: /");
    }
}