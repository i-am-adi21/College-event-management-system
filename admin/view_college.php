<?php
include 'header.php';?>
<table border="1px">
    <thead>
      <tr><th>College Name</th><th>Address</th><th>Email</th>
      <th>contact</th><th>Manage</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "dbconnect.php";
    $sql="select * from college";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    {
   
    ?>
      <tr><td><?php echo $row["college_name"]; ?></td><td><?php echo $row["address"]; ?></td><td><?php echo $row["email"]; ?></td><td><?php echo $row["contact"]; ?></td>
      <td>
         <?php echo "<a onClick=\"javascript: return confirm('Are you sure to delete this college ');\" href='delete_college.php?id=".$row['college_id']."'>Delete</a>"; ?></td>
       </tr>
      <?php
      }
      ?>