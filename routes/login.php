<?php
require_once __DIR__ . '/../databases/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (checkLogin($email, $password)) {
        $_SESSION['is_logged_in'] = true; 
        $_SESSION['timestamp'] = time();

        $_SESSION['user_id'] = getUserIdByEmail($email);
        $_SESSION['user_email'] = $email;
        $_SESSION['name'] = getUserNameByEmail($email);

        header('Location: /home');
        exit;
    } else {
        renderView('login', ['error' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
    }
} else {
    renderView('login');
}