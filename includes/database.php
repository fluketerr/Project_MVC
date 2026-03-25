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
        try {
            $conn = new mysqli($hostname, $username, $password, $dbName);
            $conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            error_log("Database connection error: " . $e->getMessage());
            http_response_code(503);
            die("Service is currently unavailable due to high load. Please try again later.");
        }
        
        if ($conn->connect_error) {
            error_log("Connection failed: " . $conn->connect_error);
            http_response_code(503);
            die("Service is currently unavailable due to high load. Please try again later.");
        }
    }
    
    return $conn;
}

// database functions ต่างๆ

require_once DATABASES_DIR . '/events.php';
require_once DATABASES_DIR . '/pictures.php';
require_once DATABASES_DIR . '/registration.php';
require_once DATABASES_DIR . '/user.php';
