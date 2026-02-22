<?php
require_once __DIR__ . '/../databases/user.php';


$result = getUsers();
renderView('users', ['title' => 'Users Information','result' => $result]);