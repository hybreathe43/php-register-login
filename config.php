<?php
$host = "localhost";
$user = "root";
$pass = null;
$dbName = "sign_up";

$conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);

if ($conn) {
    echo "Connected";
} else {
    echo "not connect";
}
