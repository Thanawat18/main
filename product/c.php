<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ธนวัฒน์ น้อยหา (แบงค์)</title>
<!--jQuery ต้องวางบนสุด -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!--ต่อด้วย dataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
	<!-- myTable คือไอดีของตารางนั้น -->
} );
</script>

</head>

<body>
<h1>ธนวัฒน์ น้อยหา (แบงค์)</h1>
<div class="container border">
<!-- table-hover คือไฮไลต์วิ่งตามเม้า -->
<table id="myTable" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
              <th>แก้ไข</th>
              <th>ลบ</th>
                <th>Picture</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Price</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
                
<?php
  include_once("connectdb.php");
  $sql = "SELECT * FROM product AS p
  LEFT JOIN category AS c
  ON p.c_id = c.c_id
  ORDER BY p.p_id ASC";
  $rs = mysqli_query($conn,$sql);
  while ($data = mysqli_fetch_array($rs)){
	  $img = "images/".$data['p_id'].".".$data['p_ext'];
  ?>
            <tr>
            <td><a href="upproduct.php" class="btn btn-warning btn-sm"><i class="bi bi-pen"></i> แก้ไข</a></td>
              <td><a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i> ลบ</a></td>
                <td><img src="<?=$img;?>"width="120"></td>
                <td><?=$data['p_name'];?></td>
                <td><?=$data['p_detail'];?></td>
                <td><?=$data['p_price'];?></td>
                <td><?=$data['c_name'];?></td>
            </tr>
 <?php          
  }
  mysqli_Close($conn);
  ?>
     </tbody>
    </table>
</div>
</body>
</html>