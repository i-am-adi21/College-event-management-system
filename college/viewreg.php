<?php
include "header.php";
include "../dbconnect.php";
session_start();
$cid=$_SESSION["userid"];
?>
<center>
    <h2><u> EVENTS Registration</u></h2>
    <br>
    
<?php

$sql="SELECT *FROM EVENT,event_registration where event_registration.event_id=event.event_id and event.college_id='$cid'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
?>

<table >
    <img src="<?php echo "../uploads/".$row['event_img']?>" width="300px" height="300px">
    <tr><th><h3><b><?php echo $row['event_name'];?></b></h3></th></tr>

    <tr><th>Description</th><td><?php echo $row['description'];?></td></tr>
    <tr><th>Registration ID:</th><td><?php echo $row['token'];?></td></tr><br>
    <tr><th>student id:</th><td><?php echo $row['student_id'];?></td></tr>
    <tr><th>Status:</th><td><?php echo $row['status'];?></td></tr>
</table>
<hr style="margin: 1.875em 0;border: none;border-bottom:solid 1px #000000;">
<?php
}

?>
</center>
</html>
