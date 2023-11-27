<?php
  include "../dbconnect.php";
  $id=$_GET["id"];
  $sql="delete  from event where event_id=$id";
  $result=mysqli_query($conn,$sql);
  if($result)
   echo "<script>alert('Deleted Successfully')</script>";
   echo '<meta http-equiv="refresh" content="0;event.php">';
  ?>