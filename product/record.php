<?php
session_start();
if (empty($_SESSION['uid'])) {
    echo "กรุณาเข้าสู่ระบบ";
    exit;
}

include("connectdb.php");

// คำนวณยอดรวม
$total = 0;
foreach ($_SESSION['sid'] as $pid) {
    $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
    $total += $sum[$pid];
}

// กำหนดค่า s_id ที่ต้องการบันทึก
$s_id = 1; // สามารถเปลี่ยนค่าได้ตามที่ต้องการ

// เพิ่มข้อมูลในตาราง orders
$sql = "INSERT INTO `orders` (o_total, o_date, u_id, s_id) VALUES ('$total', CURRENT_TIMESTAMP, '".$_SESSION['uid']."', '$s_id');";
mysqli_query($conn, $sql) or die("insert error");
$id = mysqli_insert_id($conn);

// เพิ่มข้อมูลในตาราง orders_detail
foreach ($_SESSION['sid'] as $key => $pid) {
    $sql2 = "INSERT INTO `orders_detail` (o_id, p_id, sitem) VALUES ('$id', '$pid', '".$_SESSION['sitem'][$key]."');";
    mysqli_query($conn, $sql2) or die("insert detail error");
}

// เคลียร์ข้อมูลในตะกร้า
unset($_SESSION['sid']);
unset($_SESSION['sprice']);
unset($_SESSION['sitem']);

// Redirect ไปยังหน้าที่ต้องการ
echo "<meta http-equiv='refresh' content='0;URL=mainpage.php'>";
?>
