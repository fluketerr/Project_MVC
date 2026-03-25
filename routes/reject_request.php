<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rid = (int)$_POST['rid'];
    $eid = (int)$_POST['eid'];

    $conn = getConnection();
    updateRegistrationStatus($rid, 'rejected', $conn);
    $_SESSION['message'] = "ปฏิเสธเรียบร้อย";

    header("Location: /event_request?eid=$eid");
    exit();
} else {
    header("Location: /events");
    exit();
}
