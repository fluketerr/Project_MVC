<?php

declare(strict_types=1);
session_start();


// Assume that login success
$unix_timestamp = time();
$_SESSION['timestamp'] = $unix_timestamp;

header('Location: /');