<?php
include "header.php";
include "../dbconnect.php";
?>
<center>
    <h2><u>EVENTS</u></h2>
    <br>
    <form action="search.php" method="get">
  <input type="text" name="search_query" placeholder="Search for events...">
  <button type="submit" name="s1">Search</button>
</form>
<?php

$sql="SELECT *FROM EVENT";
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
    <tr><th><?php if($row['participant_limit']>0){?><a href="event_register.php?id=<?php echo $row['event_id'];?>">Register</a><?php }else{ echo "<p style='color:red'>EVENT FULL</p>";} ?></th></tr>
</table>
<hr style="margin: 1.875em 0;border: none;border-bottom:solid 1px #000000;">
<?php
}

?>
</center>
</html>