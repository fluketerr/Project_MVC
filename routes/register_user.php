<?php
require_once __DIR__ . '/../databases/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $job = $_POST['job'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $address = $_POST['address'] ?? '';

    if (checkEmailExists($email)) {
        renderView('register_user', ['error' => 'อีเมลนี้ถูกใช้งานแล้ว']);
        exit;
    } elseif (isPassEqualConfirm($password, $confirm_password) === false) {
        renderView('register_user', ['error' => 'รหัสผ่านไม่ตรงกัน']);
        exit;
    }elseif (!isValidBirthday($birthday)) {
        renderView('register_user', ['error' => 'วันเกิดไม่ถูกต้อง']);
        exit;
    }else {
        registerUser($name, $email, $password, $birthday, $tel, $job, $gender, $address);
        header('Location: /login');
        exit;
    }
} else {
    renderView('register_user');
}

