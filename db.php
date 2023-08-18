<?php
//db.php
declare(strict_types=1);


$host = 'localhost';
$dbname = 'cursusphp';
$username = 'cursusgebruiker';
$password = 'cursuspwd';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    $db = null;
}
?>