<?php

declare(strict_types=1);

$hostname = 'localhost';
$dbName = 'project_regisevent';
$username = 'demo';
$password = '1234';
$conn = new mysqli($hostname, $username, $password, $dbName);

function getConnection(): mysqli
{   
    global $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// database functions ต่างๆ
require_once DATABASES_DIR . '/user.php';
require_once DATABASES_DIR . '/events.php';
require_once DATABASES_DIR . '/pictures.php';
require_once DATABASES_DIR . '/registration.php';
