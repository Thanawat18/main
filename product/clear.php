<?php
session_start();

// เช็คว่า session มีค่า 'sid' หรือไม่
if (isset($_SESSION['sid'])) {
    // เคลียร์ข้อมูลในตะกร้า
    unset($_SESSION['sid']);
    unset($_SESSION['sprice']);
    unset($_SESSION['sitem']);
    
    // สามารถแสดงข้อความหรือจัดการเพิ่มเติมที่นี่ได้
    // เช่นการบันทึกประวัติการลบสินค้าหรือการแสดงข้อความ

    // รีเฟรชไปยังหน้า mainpage.php
    header("Location:basket.php");
    exit;
} else {
    // หากไม่มีสินค้าในตะกร้า สามารถ redirect หรือแสดงข้อความได้
    header("Location: mainpage.php");
    exit;
}
?>
