<?php
// เปิดการรายงานข้อผิดพลาด
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
include_once("connectdb.php");

// รับข้อมูลที่ส่งมาจาก JavaScript
$data = json_decode(file_get_contents('php://input'), true);
$c_id = $data['c_id'];

// SQL สำหรับการลบหมวดหมู่
$sql = "DELETE FROM `category` WHERE `c_id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $c_id);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = mysqli_error($conn);
}

// ปิดการเชื่อมต่อฐานข้อมูล
$stmt->close();
$conn->close();

// ส่งผลลัพธ์กลับไปยัง JavaScript
header('Content-Type: application/json');
echo json_encode($response);
?>
