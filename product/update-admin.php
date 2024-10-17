<?php
// เปิดการรายงานข้อผิดพลาด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// รับข้อมูลที่ส่งมาจาก JavaScript
$a_id = $_POST['a_id'];
$a_name = $_POST['a_name'];
$a_email = $_POST['a_email'];
$a_username = $_POST['a_username'];
$a_password = $_POST['a_password']; // รหัสผ่าน (อาจจะปล่อยให้เป็นค่าว่าง)

if (isset($a_id) && isset($a_name) && isset($a_email) && isset($a_username)) {
    // SQL สำหรับการอัปเดตแอดมิน
    $sql = "UPDATE `admin` SET `a_name` = ?, `a_email` = ?, `a_username` = ?";
    
    // เพิ่มเงื่อนไขสำหรับรหัสผ่านถ้ามีการเปลี่ยนแปลง
    if (!empty($a_password)) {
        $sql .= ", `a_password` = ?";
    }
    $sql .= " WHERE `a_id` = ?";

    $stmt = $conn->prepare($sql);

    // ถ้ามีการเปลี่ยนแปลงรหัสผ่าน
    if (!empty($a_password)) {
        $stmt->bind_param("ssssi", $a_name, $a_email, $a_username, md5($a_password), $a_id);
    } else {
        $stmt->bind_param("sssi", $a_name, $a_email, $a_username, $a_id);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ครบถ้วน']);
}

$conn->close();
?>
