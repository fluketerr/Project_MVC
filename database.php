<?php

declare(strict_types=1);

$conn = null;

function getConnection(): mysqli
{   
    global $conn;
    
    $hostname = 'gonggang.net';
    $dbName = 'u910454988_regify';
    $username = 'u910454988_regify';
    $password = 'I3WdSE]WGe;c6!tH';
    
    if ($conn === null) {
        $conn = new mysqli('p:' . $hostname, $username, $password, $dbName);
        $conn->set_charset("utf8mb4");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    
    return $conn;
}

// database functions ต่างๆ
require_once DATABASES_DIR . '/user.php';
require_once DATABASES_DIR . '/events.php';
require_once DATABASES_DIR . '/pictures.php';
require_once DATABASES_DIR . '/registration.php';
require_once DATABASES_DIR . '/user.php';
