<?php
// เชื่อมต่อกับฐานข้อมูล
include("connectdb.php");
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินอยู่หรือไม่
if (!isset($_SESSION['u_id'])) {
    echo "กรุณาล็อกอินเพื่อทำการสั่งซื้อ";
    exit;
}

$u_id = $_SESSION['u_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$payment_method = $_POST['payment_method'];
$totalAmount = $_POST['totalAmount'];
$slip_path = null; // สำหรับเก็บที่อยู่ของสลิป

if ($payment_method == 'bank_transfer') {
    // ตรวจสอบการอัปโหลดสลิป
    if (isset($_FILES['payment_slip']) && $_FILES['payment_slip']['error'] == 0) {
        // ตรวจสอบประเภทไฟล์
        $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($_FILES['payment_slip']['type'], $allowed_types)) {
            echo "ประเภทไฟล์ไม่ถูกต้อง กรุณาอัปโหลดไฟล์ภาพเท่านั้น";
            exit;
        }

        // ตรวจสอบขนาดไฟล์ (ไม่เกิน 2MB)
        if ($_FILES['payment_slip']['size'] > 2000000) {
            echo "ขนาดไฟล์ต้องไม่เกิน 2MB";
            exit;
        }

        // จัดการไฟล์สลิปการโอนเงิน
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["payment_slip"]["name"]);
        move_uploaded_file($_FILES["payment_slip"]["tmp_name"], $target_file);
        $slip_path = $target_file; // บันทึกที่อยู่ของไฟล์
    } else {
        echo "กรุณาแนบสลิปการโอนเงิน";
        exit;
    }
}

// บันทึกข้อมูลลงในตาราง orders
$sql = "INSERT INTO orders (u_id, o_total, o_date, name, address, phone, payment_method, payment_slip) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("idsssss", $u_id, $totalAmount, $name, $address, $phone, $payment_method, $slip_path);

if ($stmt->execute()) {
    echo "คำสั่งซื้อของคุณได้รับการยืนยันเรียบร้อยแล้ว!";
} else {
    echo "เกิดข้อผิดพลาด: " . $stmt->error;
}

// ปิดการเชื่อมต่อ
$stmt->close();
$conn->close();
?>
