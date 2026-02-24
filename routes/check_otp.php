<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $eid = (int)$_POST['eid'];
    $uid = (int)$_POST['uid'];
    $otp = $_POST['otp'];

    $otpGen = generateOTP($uid, $eid);

    // ❌ ไม่พบผู้ใช้
    if (getUsersById($uid)->num_rows === 0) {
        $_SESSION['notice'] = 'ไม่พบ UID';
        $_SESSION['notice_type'] = 'error';
        header("Location: /manage_event");
        exit();
    }

    // ❌ ไม่ได้ลงทะเบียนกิจกรรม
    if (getUserRegisById($eid, $uid)->num_rows === 0) {
        $_SESSION['notice'] = 'ไม่ได้เข้าร่วมกิจกรรม';
        $_SESSION['notice_type'] = 'warning';
        header("Location: /manage_event");
        exit();
    }

    // ✅ OTP ถูกต้อง
    if ($otp === $otpGen) {

        if (updateCheckIn($uid, $eid)) {
            $_SESSION['notice'] = 'เช็คชื่อสำเร็จ ✅';
            $_SESSION['notice_type'] = 'success';
        } else {
            $_SESSION['notice'] = 'ไม่ได้รับอนุญาตเข้าร่วมงาน';
            $_SESSION['notice_type'] = 'error';
        }

    } else {
        $_SESSION['notice'] = 'OTP ไม่ถูกต้อง ❌';
        $_SESSION['notice_type'] = 'error';
    }

    header("Location: /manage_event");
    exit();
}
