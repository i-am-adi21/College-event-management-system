<?php
include 'header.php';?>
<table id="example" >
    <thead>
      <tr><th>Category Name</th>
        <th>Manage</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "dbconnect.php";
    $sql="select * from category";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    {
   
    ?>
      <tr><td><?php echo $row["cat_name"]; ?></td>
      <td>
         <?php echo "<a onClick=\"javascript: return confirm('Are you sure to delete this Category');\" href='delete_category.php?id=".$row['cat_id']."'>Delete</a>"; ?></td>
       </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <a href="add_category.php">Add Category</a>
  </html>