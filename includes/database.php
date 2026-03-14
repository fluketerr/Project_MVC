<?php

declare(strict_types=1);

$hostname = 'gonggang.net';
$dbName = 'u910454988_regify';
$username = 'u910454988_regify';
$password = 'I3WdSE]WGe;c6!tH';


$conn = new mysqli($hostname, $username, $password, $dbName);
$conn->set_charset("utf8mb4");

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
require_once DATABASES_DIR . '/user.php';
