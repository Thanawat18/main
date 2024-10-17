<?php
	session_start();
 include("connectdb.php");
?>
<!doctype html>
<html lang="en" data-bs-theme="auto"><head><script src="../assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Checkout example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
		body {
			background-image: url('images/123.png');
			background-size: cover;
			background-position: center;
			height: 100%;
		}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
	  .form-signin {
		max-width: 800px;
		width: 100%; 
		margin: auto;
		padding: 50px;
		background-color: rgba(255, 255, 255, 0.5);
		border-radius: 10px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
		height: 1100px; /* กำหนดความสูงคงที่ */
    /* หรือใช้ min-height สำหรับความสูงขั้นต่ำ */
    /* min-height: 500px; */
	}
		        .navbar {
            background-color: rgba(211, 211, 211, 0.5); /* สีเทาจาง ๆ */
        }

    </style>

    
    <!-- Custom styles for this template -->
    <link href="checkout.css" rel="stylesheet">
  </head>
  <body class="bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>
<!-- Navbar เริ่มต้น -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
		<div class="container-fluid">
    <!-- ใช้ ms-auto เพื่อขยับไปทางขวา -->
    <a class="navbar-brand ms-auto" href="index.php">Homepage</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
<div class="container">
<main class="form-signin w-100 m-100" style="margin-top: 100px;">
    <div class="row g-5 justify-content-center align-items-center vh-100">
        <div class="col-md-7 col-lg-8" align="center">
            <form id="registrationForm" class="needs-validation" action="" method="post" novalidate>
                <div class="row g-3">
                    <div class="col-sm-12">
                        <img class="d-block mx-auto mb-4" src="images/12345.png" alt="" width="125" height="125">
                        <h2>การสมัครสมาชิก</h2>
                        <p class="lead">กรอกข้อมูลเพื่อสมัครสมาชิก</p>
                    </div>

                    <div class="col-sm-12">
                        <label for="fullname" class="form-label">Full name</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                            <input type="text" name="fullname" class="form-control" placeholder="Fullname" required autofocus>
                            <div class="invalid-feedback">
                                กรุณากรอกชื่อ - นามสกุล
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                                กรุณากรอก อีเมล
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="invalid-feedback">
                                กรุณากรอก รหัสผ่าน
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-map-fill"></i></span>
                            <input type="text" class="form-control" name="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                กรุณากรอก ที่อยู่
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="tel" class="form-label">Phone</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                            <input type="text" class="form-control" name="tel" placeholder="080xxxxxxx" required>
                            <div class="invalid-feedback">
                                กรุณากรอก หมายเลขโทรศัพท์
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-map-fill"></i></span>
                            <input type="text" class="form-control" name="address2" placeholder="Apartment or suite">
                        </div>
                    </div>

                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary btn-lg" id="submitButton">สมัครสมาชิก</button>
                </div>
            </form>
<?php
require_once("connectdb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];

	$sql = "INSERT INTO `users` (`u_fullname`, `u_email`, `u_password`, `u_tel`, `u_address`, `u_address2`) 
            VALUES ('$fullname','$email',md5('$password'),'$tel','$address','$address2')";
    
    if (mysqli_query($conn, $sql)) {
        $modalTitle = "สมัครสมาชิกสำเร็จ";
        $modalBody = "คุณได้สมัครสมาชิกเรียบร้อยแล้ว!";
        // แสดง modal โดยใช้ JavaScript
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        });</script>";
    } else {
        $modalTitle = "เกิดข้อผิดพลาด";
        $modalBody = "ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง!";
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        });</script>";
    }
}
mysqli_close($conn);
?>
			
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo isset($modalTitle) ? $modalTitle : ''; ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <p><?php echo isset($modalBody) ? $modalBody : ''; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="window.location.href='sign-in.php'">Sign-in</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php'" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('submitButton').addEventListener('click', function() {
        const form = document.getElementById('registrationForm');

        // ตรวจสอบความถูกต้องของฟอร์ม
        if (form.checkValidity() === false) {
            form.classList.add('was-validated'); // แสดง invalid feedback
            return; // ไม่เปิด modal หากข้อมูลไม่ครบ
        }

        // ถ้าข้อมูลครบ ให้แสดง modal
        const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
        modal.show();
    });
</script>
<script>
    <?php if (isset($message)) : ?>
        const modalSheet = new bootstrap.Modal(document.getElementById('modalSheet'));
        modalSheet.show();
    <?php endif; ?>
</script>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">&copy; 2017–2024 บ้านหนังสือติดปีก</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="checkout.js"></script></body>
</html>
