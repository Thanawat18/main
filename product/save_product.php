<?php
include_once("connectdb.php");

if (isset($_POST)) {
    $pid = $_GET['pid'];
    
    $sql = "UPDATE `product` SET 
            `p_name` = '{$_POST['pname']}',
            `p_detail` = '{$_POST['pdetail']}',
            `p_price` = '{$_POST['pprice']}',
            `c_id` = '{$_POST['pcat']}'";

    // อัปโหลดรูปภาพหลัก
    if (!empty($_FILES['pimg']['name'])) {
        $file_name = $_FILES['pimg']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $sql .= ", p_ext='{$ext}'";
        move_uploaded_file($_FILES['pimg']['tmp_name'], "images/{$pid}.".$ext);
    }

    // อัปโหลด Picture-Detail
    if (!empty($_FILES['pd']['name'])) {
        $pd_name = $_FILES['pd']['name'];
        $pd_ext = pathinfo($pd_name, PATHINFO_EXTENSION);
        $sql .= ", pd_ext='{$pd_ext}'";
        move_uploaded_file($_FILES['pd']['tmp_name'], "images/pd_{$pid}.".$pd_ext);
    }

    // อัปโหลด Picture-Detail2
    if (!empty($_FILES['pd2']['name'])) {
        $pd2_name = $_FILES['pd2']['name'];
        $pd2_ext = pathinfo($pd2_name, PATHINFO_EXTENSION);
        $sql .= ", pd_ext2='{$pd2_ext}'";
        move_uploaded_file($_FILES['pd2']['tmp_name'], "images/pd2_{$pid}.".$pd2_ext);
    }

    $sql .= " WHERE `p_id` = '{$pid}'";

    if (mysqli_query($conn, $sql)) {
        echo "แก้ไขข้อมูลสินค้าสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
