<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $a_name = $_POST['a_name'];
    $a_email = $_POST['a_email'];
    $a_username = $_POST['a_username'];
    $a_password = $_POST['a_password']; // รหัสผ่านที่ถูกเข้ารหัสเป็น MD5

    // เชื่อมต่อฐานข้อมูล
    $conn = new mysqli('localhost', 'root', '', 'shop1'); // เปลี่ยนข้อมูลตามการเชื่อมต่อจริง

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'error' => 'Database connection failed: ' . $conn->connect_error]);
        exit();
    }

    // ตรวจสอบว่ามีผู้ใช้นี้อยู่ในฐานข้อมูลแล้วหรือไม่
    $checkUserSql = "SELECT * FROM admin WHERE a_username = ?";
    $checkStmt = $conn->prepare($checkUserSql);
    $checkStmt->bind_param("s", $a_username);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo json_encode(['success' => false, 'error' => 'Username already exists.']);
        $checkStmt->close();
        $conn->close();
        exit();
    }

    // บันทึกข้อมูลแอดมิน
    $sql = "INSERT INTO admin (a_name, a_email, a_username, a_password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $a_name, $a_email, $a_username, $a_password);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'SQL Error: ' . $stmt->error]);
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $checkStmt->close();
    $conn->close();
}
?>
