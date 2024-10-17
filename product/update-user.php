<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include("connectdb.php");

// ตรวจสอบว่ามีข้อมูล POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลที่ส่งมาจากแบบฟอร์ม
    $u_id = $_POST['u_id'];
    $u_fullname = $_POST['u_fullname'];
    $u_email = $_POST['u_email'];
    $u_tel = $_POST['u_tel'];
    $u_address = $_POST['u_address'];
    $u_address2 = $_POST['u_address2'];
    $u_address3 = $_POST['u_address3'];
    $u_address4 = $_POST['u_address4'];
    $u_address5 = $_POST['u_address5'];

    // เตรียมคำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE users SET 
                u_fullname = ?, 
                u_email = ?, 
                u_tel = ?, 
                u_address = ?, 
                u_address2 = ?, 
                u_address3 = ?, 
                u_address4 = ?, 
                u_address5 = ?
            WHERE u_id = ?";

    // ใช้ prepared statement เพื่อป้องกัน SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $u_fullname, $u_email, $u_tel, $u_address, $u_address2, $u_address3, $u_address4, $u_address5, $u_id);

    // ตรวจสอบการอัปเดต
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาด: " . $stmt->error]);
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "คำขอไม่ถูกต้อง"]);
}
?>
