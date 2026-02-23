<?php
session_start();
// require_once 'models/registration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rid = (int)$_POST['rid'];

    $conn = getConnection();
    updateRegistrationStatus($rid, 'approved', $conn);

    $_SESSION['message'] = "อนุมัติเรียบร้อย";
}

header("Location: /request_event");
exit();