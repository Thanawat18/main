<?php
    session_start();
    include("connectdb.php");

    if (isset($_POST['Submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];

        $sql = "INSERT INTO `users` (`u_fullname`, `u_email`, `u_password`, `u_tel`, `u_address`) 
                VALUES ('$fullname','$email',md5('$password'),'$tel','$address')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "สมัครสมาชิกสำเร็จ";
            $modalTitle = "สมัครสมาชิกสำเร็จ";
            $modalBody = "คุณได้สมัครสมาชิกเรียบร้อยแล้ว!";
        } else {
            $message = "ไม่สามารถสมัครสมาชิกได้";
            $modalTitle = "เกิดข้อผิดพลาด";
            $modalBody = "กรุณาลองใหม่อีกครั้ง!";
        }
    }
    mysqli_close($conn);
?>

<!-- Modal -->
<div class="modal fade" id="modalSheet" tabindex="-1" role="dialog" aria-labelledby="modalSheetLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header border-bottom-0">
        <h1 class="modal-title fs-5"><?php echo isset($modalTitle) ? $modalTitle : ''; ?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-0">
        <p><?php echo isset($modalBody) ? $modalBody : ''; ?></p>
      </div>
      <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
        <button type="button" class="btn btn-lg btn-primary" data-bs-dismiss="modal">ตกลง</button>
        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<script>
    <?php if (isset($message)) : ?>
        const modalSheet = new bootstrap.Modal(document.getElementById('modalSheet'));
        modalSheet.show();
    <?php endif; ?>
</script>
