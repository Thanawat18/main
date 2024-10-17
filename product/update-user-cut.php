<?php
include("connectdb.php");

// ตรวจสอบการส่งข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $u_id = $_POST['u_id'];
    $u_fullname = $_POST['u_fullname'];
    $u_email = $_POST['u_email'];
    $u_tel = $_POST['u_tel'];
    $u_address = $_POST['u_address'];
    $u_address2 = $_POST['u_address2'];
    $u_address3 = $_POST['u_address3'];
    $u_address4 = $_POST['u_address4'];
    $u_address5 = $_POST['u_address5'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE users SET 
                u_fullname = '$u_fullname',
                u_email = '$u_email',
                u_tel = '$u_tel',
                u_address = '$u_address',
                u_address2 = '$u_address2',
                u_address3 = '$u_address3',
                u_address4 = '$u_address4',
                u_address5 = '$u_address5'
            WHERE u_id = '$u_id'";

    // รันคำสั่ง SQL
    if ($conn->query($sql) === TRUE) {
        // ถ้าสำเร็จ
        $response = array("success" => true);
    } else {
        // ถ้าเกิดข้อผิดพลาด
        $response = array("success" => false, "message" => $conn->error);
    }

    // ส่งข้อมูลกลับในรูปแบบ JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
