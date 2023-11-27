<?php
include 'header.php';?>
<table id="example" border="1px" >
    <thead>
      <tr><th>Event Name</th><th>Event Description<th><th>Event Date</th>
      <th>Event category</th><th>venue</th>
      <th>contact</th><th>Image</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "dbconnect.php";
    $sql="select * from event,category where cat_id=category_id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    {
   
    ?>
      <tr><td><?php echo $row["event_name"]; ?></td><td><?php echo $row["description"];?>
    </td><td><?php echo $row["date"]; ?></td><td><?php echo $row["cat_name"]; ?></td><td><?php echo $row["venue"]; ?>
    <td><?php echo $row["contact"]; ?></td><td><img src="../uploads/<?php echo $row["event_img"]; ?>" ></td>

       </tr>
      <?php
      }
      ?>
    </tbody>
  </table>