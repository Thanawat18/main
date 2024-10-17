<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูล JSON ที่ส่งมาจาก fetch
    $data = json_decode(file_get_contents('php://input'), true);

    // ตรวจสอบว่าได้รับ p_id และ ext หรือไม่
    if (isset($data['p_id']) && isset($data['ext'])) {
        include("connectdb.php");

        // กำหนดค่า p_id และ ext
        $p_id = $data['p_id'];
        $ext = $data['ext'];

        // ลบสินค้าออกจากตาราง product
        $sql = "DELETE FROM product WHERE p_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $p_id);

        if ($stmt->execute()) {
            // ลบไฟล์ภาพที่เกี่ยวข้อง ถ้ามีหลายไฟล์ให้เพิ่มการลบไฟล์เพิ่มเติม
            $imagePaths = [
                "images/" . $p_id . "." . $ext,
                "images/" . $p_id . "." . $data['pd_ext'],
                "images/" . $p_id . "." . $data['pd_ext2']
            ];

            foreach ($imagePaths as $imagePath) {
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ลบสินค้าไม่สำเร็จ']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ข้อมูลไม่ครบถ้วน']);
    }
}
?>
