<?php
// เชื่อมต่อฐานข้อมูล
include("connectdb.php"); // ใช้ไฟล์เชื่อมต่อฐานข้อมูลที่คุณมีอยู่แล้ว

// ตรวจสอบว่าข้อมูลถูกส่งมาแบบ POST และเป็น JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจาก request body
    $data = json_decode(file_get_contents('php://input'), true);

    // ตรวจสอบว่ามี o_id ถูกส่งมา
    if (isset($data['o_id'])) {
        $o_id = $data['o_id'];

        // เตรียมคำสั่ง SQL สำหรับการลบ
        $sql = "DELETE FROM orders WHERE o_id = ?";
        
        // เตรียม statement เพื่อป้องกัน SQL Injection
        if ($stmt = $conn->prepare($sql)) {
            // ผูกค่า o_id เข้ากับ statement
            $stmt->bind_param("i", $o_id);

            // ดำเนินการลบ
            if ($stmt->execute()) {
                // ส่งผลลัพธ์กลับเป็น JSON (ลบสำเร็จ)
                echo json_encode(["success" => true]);
            } else {
                // ส่งข้อความแสดงข้อผิดพลาดหากการลบล้มเหลว
                echo json_encode(["success" => false, "message" => "การลบคำสั่งซื้อล้มเหลว"]);
            }

            // ปิด statement
            $stmt->close();
        } else {
            // ส่งข้อความแสดงข้อผิดพลาดหากการเตรียม statement ล้มเหลว
            echo json_encode(["success" => false, "message" => "การเตรียมคำสั่ง SQL ล้มเหลว"]);
        }
    } else {
        // ส่งข้อความแสดงข้อผิดพลาดหากไม่มี o_id ถูกส่งมา
        echo json_encode(["success" => false, "message" => "ไม่มี o_id ถูกส่งมา"]);
    }
} else {
    // หาก request ไม่ใช่ POST ให้ส่งข้อผิดพลาดกลับไป
    echo json_encode(["success" => false, "message" => "ไม่รองรับวิธีการร้องขอนี้"]);
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
