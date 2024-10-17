<?php
session_start();
include("connectdb.php");

if (isset($_GET['id'])) {
    $u_id = $_GET['id'];
    
    // เตรียมและ execute คำสั่ง SQL
    $stmt = $conn->prepare("SELECT u_fullname, u_email, u_tel, u_address, u_address2, u_address3, u_address4, u_address5 FROM users WHERE u_id = :u_id");
    $stmt->bindParam(':u_id', $u_id);
    $stmt->execute();

    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profile) {
        echo json_encode(['success' => true, 'profile' => $profile]);
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลโปรไฟล์']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่มี ID ของผู้ใช้']);
}
?>
