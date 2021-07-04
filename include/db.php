<?php
$Option = [
    PDO::ATTR_PERSISTENT => TRUE,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
date_default_timezone_set("Asia/Tehran");
try {
    $connection = new PDO('mysql:host=localhost;dbname=test', 'root', '', $Option);
    $connection->exec("SET CHARACTER SET UTF8");
} catch(PDOException $e) {
    echo $e->getMessage();
}