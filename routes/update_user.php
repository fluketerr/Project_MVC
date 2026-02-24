<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$id = $_SESSION['user_id'];

// --- Helper: Fetch and Split User Data ---
$result = getUsersById($id);
$currentUser = $result ? $result->fetch_assoc() : null;

if (!$currentUser) {
    die("User not found.");
}

// Split the full name into parts
$nameParts = explode(' ', $currentUser['name'] ?? '', 2);
$currentFirstName = $nameParts[0] ?? '';
$currentLastName = $nameParts[1] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Process Post Data (using fallback to DB values)
    $firstName = !empty($_POST['first_name']) ? trim($_POST['first_name']) : $currentFirstName;
    $lastName  = !empty($_POST['last_name'])  ? trim($_POST['last_name'])  : $currentLastName;
    
    $birthday = $_POST['birthday'] ?: $currentUser['birthday'];
    $tel      = $_POST['tel']      ?: $currentUser['tel'];
    $job      = $_POST['job']      ?: $currentUser['job'];
    $gender   = $_POST['gender']   ?: $currentUser['gender'];
    $address  = $_POST['address']  ?: $currentUser['address'];

    $fullName = trim($firstName . ' ' . $lastName);

    // 2. Update Database
    $res = updateUserData($id, $fullName, $birthday, $tel, $job, $gender, $address);
    
    if ($res === true) { 
        header('Location: /users?status=updated');
        exit;
    } else {
        // Pass current POST data back so the user doesn't lose their typing
        renderView('update_user', [
            'first_name' => $_POST['first_name'],
            'last_name'  => $_POST['last_name'],
            'user'       => $_POST, 
            'error'      => 'Failed to update profile.'
        ]);
        exit;
    }
} else {
    // --- GET Request: Display Form ---
    renderView('update_user', [
        'first_name' => $currentFirstName,
        'last_name'  => $currentLastName,
        'user'       => $currentUser
    ]);
}