<?php
include('connectdb.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $o_id = $_POST['o_id'];
    $s_id = $_POST['s_id'];

    // อัปเดตข้อมูลสถานะคำสั่งซื้อ
    $sql = "UPDATE orders SET s_id = ? WHERE o_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $s_id, $o_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'อัปเดตสถานะคำสั่งซื้อสำเร็จ']);
    } else {
        echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตสถานะคำสั่งซื้อ']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่รองรับคำขอนี้']);
}
?>
