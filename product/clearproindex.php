<?php
	@session_start();
	session_destroy();

		echo "กำลังกลับหน้าหลัก กรุณารอสักครู่....";
		// อาจจะต้องทำการ redirect ไปที่หน้าเดิม เพื่อป้องกันการโหลดซ้ำ
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=index.php\">";
		//header("Location: mainpage.php");

?>
<meta charset="utf-8">