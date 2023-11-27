<?php
include "header.php";
include "../dbconnect.php";
session_start();
$sid=$_SESSION["userid"];
?>
<center>
    <h2><u>MY EVENTS</u></h2>
    <br>
    
<?php

$sql="SELECT *FROM EVENT,event_registration where event_registration.event_id=event.event_id and student_id='$sid'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
?>

<table>
    <img src="<?php echo "../uploads/".$row['event_img']?>" width="300px" height="300px">
    <tr><th><h3><b><?php echo $row['event_name'];?></b></h3></th></tr>
    <tr><th><img href="/../uploads/<?php echo $row['event_img']?>"></th></tr>
    <tr><th>Description</th><td><?php echo $row['description'];?></td></tr>
    <tr><th>Participants:</th><td><?php echo $row['participant_limit'];?></td></tr>
    <tr><th>STATUS: </th><td style="color:red"><?php echo $row['status'];?></td></tr>
    <tr><th><a href="event_register.php?id=<?php echo $row['event_id'];?>">Go to Registration</a></th></tr>
    <tr><th><a href="event_cancel.php?id=<?php echo $row['event_id'];?>">Cancel Registration</a></th></tr>
</table>
<hr style="margin: 1.875em 0;border: none;border-bottom:solid 1px #000000;">
<?php
}

?>
</center>
</html>