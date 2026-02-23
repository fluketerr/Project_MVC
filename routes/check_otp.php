<?php
$eid = $_POST['eid'];
$uid = $_POST['uid'];
$otp = $_POST['otp'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $TemOtp = generateOTP($uid,$eid);
    if($otp==$TemOtp){
        updateCheckIn($uid,$eid)?$_SESSION['notice'] ='OTP ถูกต้อง':'';
        
    }else{
        $_SESSION['notice'] ='OTP ไม่ถูกต้อง'. $TemOtp;
    }
    header("Location: events");
    exit();
}