<?php 
session_start();
// ลบข้อมูล session ทั้งหมด
$_SESSION = [];
// ทำลาย session
session_destroy();
// เปลี่ยนเส้นทางกลับไปยังหน้าแรกหรือหน้า login
header('Location: /');
exit;   