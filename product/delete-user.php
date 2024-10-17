<?php
// รวมไฟล์สำหรับเชื่อมต่อฐานข้อมูล
include("connectdb.php");

// รับข้อมูล JSON ที่ส่งจาก fetch
$data = json_decode(file_get_contents("php://input"), true);

// ตรวจสอบว่ามี u_id ในข้อมูลที่ได้รับหรือไม่
if (isset($data['u_id'])) {
    $u_id = $data['u_id'];

    // สร้าง SQL query เพื่อลบผู้ใช้
    $sql = "DELETE FROM users WHERE u_id = ?";

    // เตรียม statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $u_id); // "i" ระบุว่า u_id เป็น integer

    // ลบข้อมูล
    if ($stmt->execute()) {
        // หากลบสำเร็จ
        echo json_encode(["success" => true]);
    } else {
        // หากลบไม่สำเร็จ
        echo json_encode(["success" => false, "message" => "ไม่สามารถลบผู้ใช้ได้"]);
    }

    // ปิด statement
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "ไม่พบ ID ของผู้ใช้"]);
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
