
<?php
  include "dbconnect.php";
  $id=$_GET["id"];
  $sql="delete  from feedback where feedback_id=$id";
  $result=mysqli_query($conn,$sql);
  if($result)
   echo "<script>alert('Deleted Successfully')</script>";
   echo '<meta http-equiv="refresh" content="0;view_feedback.php">';
  ?>