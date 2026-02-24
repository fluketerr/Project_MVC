<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rid = (int)$_POST['rid'];

    $conn = getConnection();
    updateRegistrationStatus($rid, 'rejected', $conn);

    $_SESSION['message'] = "ปฏิเสธเรียบร้อย";
}

header("Location: /request_event");
exit();