<?php
include('connectdb.php'); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีการส่งค่า o_id มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['o_id'])) {
        $o_id = $input['o_id'];

        // ดึงข้อมูลคำสั่งซื้อจากฐานข้อมูล
        $sql = "SELECT o_id, s_id, o_total, o_date, u_id FROM orders WHERE o_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $o_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();

            // ดึงข้อมูลผู้ใช้ที่เกี่ยวข้อง
            $user_sql = "SELECT u_fullname FROM users WHERE u_id = ?";
            $user_stmt = $conn->prepare($user_sql);
            $user_stmt->bind_param("i", $data['u_id']);
            $user_stmt->execute();
            $user_result = $user_stmt->get_result();
            $user_data = $user_result->fetch_assoc();

            // รวมข้อมูลคำสั่งซื้อและชื่อผู้ใช้
            $data['u_fullname'] = $user_data['u_fullname'];

            // ส่งข้อมูลกลับในรูปแบบ JSON
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ไม่พบข้อมูลคำสั่งซื้อ']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่ได้ระบุ o_id']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ไม่รองรับคำขอนี้']);
}
?>
