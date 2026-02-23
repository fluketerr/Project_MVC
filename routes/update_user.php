<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];

    $result = getUsersById($id);
    
    $currentUser = $result->fetch_assoc();

    $oldNameParts = explode(' ', $currentUser['name'] ?? ' ', 2);
    $oldFirstName = $oldNameParts[0] ?? '';
    $oldLastName = $oldNameParts[1] ?? '';

    $first_name = !empty($_POST['name']) ? $_POST['name'] : $oldFirstName;
    $last_name = !empty($_POST['surname']) ? $_POST['surname'] : $oldLastName;

    $birthday = !empty($_POST['birthday']) ? $_POST['birthday'] : $currentUser['birthday'];
    $tel = !empty($_POST['tel']) ? $_POST['tel'] : $currentUser['tel'];
    $job = !empty($_POST['job']) ? $_POST['job'] : $currentUser['job'];
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : $currentUser['gender'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $currentUser['address'];

    $name = trim($first_name . ' ' . $last_name);

    $id = $_SESSION['user_id'] ?? null;
    
    $res = updateUserData($id, $name, $birthday, $tel, $job, $gender, $address);
    
    if ($res === true) { 
        header('Location: /users');
        exit;
    } else {
        renderView('update_user', ['user' => $_POST, 'error' => 'Something went wrong! on update user']);
        exit;
    }
} else {
    $id = $_SESSION['user_id'];
    
    $currentUser = getUsersById($id);

    // ส่งข้อมูลผู้ใช้ปัจจุบันไปยัง view เพื่อแสดงในฟอร์ม
    renderView('update_user', ['user' => $currentUser]);
}