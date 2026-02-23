<?php

$eid = $_POST['eid'];
$uid = (int)$_POST['uid'];
$otp = $_POST['otp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otpGen = generateOTP($uid, $eid);
    if (getUsersById($uid)->num_rows === 0) {
        $_SESSION['notice'] = 'ไม่พบ uid';
        header("Location: /events");
        exit();
    }
    if (getUserRegisById($eid,$uid)->num_rows === 0) {
        $_SESSION['notice'] = 'ไม่ได้เข้าร่วมกิจกรรม';
        header("Location: /events");
        exit();
    }
    if ($otp == $otpGen) {
        updateCheckIn($uid, $eid) ? $_SESSION['notice'] = 'OTP ถูกต้อง' : $_SESSION['notice'] = 'ไม่ได้รับอนุญาตเข้าร่วมงาน';
    } else {
        $_SESSION['notice'] = 'OTP ไม่ถูกต้อง' . $otpGen;
    }
    header("Location: events");
    exit();
}
