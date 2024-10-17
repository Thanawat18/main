<?php

if (!isset($_SESSION['uid'])) { // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
    header('Location: mainpage.php'); // เปลี่ยนเส้นทางถ้าไม่เข้าสู่ระบบ
    exit; // ออกจาก script หลังจาก redirect
}
?>
