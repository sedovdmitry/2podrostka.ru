<?php
require_once './config/constants.php';
require_once './config/database.php';

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "Connection successful!";
} else {
    echo "Connection failed. Check logs.";
}
?>