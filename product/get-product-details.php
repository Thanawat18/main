<?php
include_once("connectdb.php");

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    $sql = "SELECT * FROM product WHERE p_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(["error" => "Product not found"]);
    }
} else {
    echo json_encode(["error" => "No product ID provided"]);
}

$conn->close();
?>
