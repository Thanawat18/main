<?php
// เปิดการรายงานข้อผิดพลาด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// รับข้อมูลที่ส่งมาจาก JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$a_id = $data['a_id'];

// ตรวจสอบว่าได้ส่ง a_id มาหรือไม่
if (isset($a_id)) {
    // SQL สำหรับการลบแอดมิน
    $sql = "DELETE FROM `admin` WHERE `a_id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $a_id);

    // ตรวจสอบการทำงานของ SQL
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบแอดมินที่มี ID นี้']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID แอดมินไม่ถูกต้อง']);
}

$conn->close();
?>
