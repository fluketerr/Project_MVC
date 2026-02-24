<<<<<<< HEAD
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rid = (int)$_POST['rid'];

    $conn = getConnection();
    updateRegistrationStatus($rid, 'rejected', $conn);

    $_SESSION['message'] = "ปฏิเสธเรียบร้อย";
}

header("Location: /request_event");
=======
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rid = (int)$_POST['rid'];

    $conn = getConnection();
    updateRegistrationStatus($rid, 'rejected', $conn);

    $_SESSION['message'] = "ปฏิเสธเรียบร้อย";
}

header("Location: /request_event");
>>>>>>> 2d8433b2891750682c5b04378ab48b7a10450b43
exit();