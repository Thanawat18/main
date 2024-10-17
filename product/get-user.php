<?php
include("connectdb.php"); // เชื่อมต่อกับฐานข้อมูล

if (isset($_POST['u_id'])) {
    $u_id = $_POST['u_id'];
    
    $sql = "SELECT * FROM users WHERE u_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $u_id); // bind ค่าที่เป็น integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'data' => $user
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'ไม่พบข้อมูลผู้ใช้'
        ]);
    }
    $stmt->close();
}
$conn->close();
?>
