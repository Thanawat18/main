<?php
	session_start();
 include("connectdb.php");
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Signin Template · Bootstrap v5.3</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/123.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .form-signin {
            max-width: 500px;
            margin: auto;
            padding: 50px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-signin img {
            display: block;
            margin: 0 auto 20px;
        }
        .navbar {
            background-color: rgba(211, 211, 211, 0.5); /* สีเทาจาง ๆ */
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <!-- Navbar เริ่มต้น -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Homepage</a> <!-- ย้ายไปซ้ายสุด -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- Navbar สิ้นสุด -->

    <!-- เนื้อหาหลัก -->
    <main class="form-signin w-50 m-100" style="margin-top: 100px;">
        <form method="post" action="">
            <img src="images/12345.png" alt="" width="200" height="180">
            <h1 class="h3 mb-3 fw-normal" align="center">เข้าสู่ระบบ</h1>
            <div class="form-floating">
                <input type="text" class="form-control" name="ausername" placeholder="username" autofocus required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="apassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" name="Submit">Sign in</button>
        </form>
    </main>
    
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

<?php
    if (isset($_POST['Submit'])) {
        // เชื่อมต่อกับฐานข้อมูล (ตรวจสอบให้แน่ใจว่ามีการเชื่อมต่อ)
        include("connectdb.php");
        
        // ตรวจสอบ username และ password ที่รับเข้ามา และทำการเข้ารหัส password ด้วย md5
        $sql = "SELECT * FROM `admin` WHERE `a_username` ='{$_POST['ausername']}' AND `a_password` ='" . md5($_POST['apassword']) . "'";
        $rs = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($rs);
        
        if ($num > 0) {
            // หากพบข้อมูลผู้ใช้ในฐานข้อมูล
            $data = mysqli_fetch_array($rs);
            $_SESSION['aid'] = $data['a_id'];  // ใช้ a_id แทน u_id สำหรับ admin
            $_SESSION['aname'] = $data['a_name'];  // ใช้ a_fullname แทน u_fullname สำหรับ admin
            echo "<script>";
            echo "window.location='adminpage.php';";  // เปลี่ยนเป็นหน้า admin ที่ต้องการ redirect
            echo "</script>";
        } else {
            // ถ้า username หรือ password ไม่ถูกต้อง
            echo "<script>";
            echo "alert('Username หรือ Password ไม่ถูกต้อง');";
            echo "</script>";
        }
    }
?>
</body>
</html>
