<?php
include 'header.php';
?>
<table border="1px" >
    <thead>
      <tr><th>Student name</th><th>Feedback</th><th>Reply</th><th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
    include "dbconnect.php";
    $sql="select * from feedback,student where user_id=student_id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result))
    {
   
    ?>
      <tr><td><?php echo $row["student_name"]; ?></td><td><?php echo $row["feedback"];?></td>
      <td>
    <?php $fid= $row['feedback_id']?><?php if($row["reply"]!=NULL)
      {
        echo $row["reply"];
      }
      else
     {
      ?>
      <form action="view_feedback.php" method="post">
      <input type='text' name='reply'>
      <br><input type='submit' name='submit' value='submit'></form>
      <?php
        if(isset($_POST["submit"]))
        {
          $reply = $_POST["reply"];
         $sql="update feedback set reply='$reply' where feedback_id='$fid'";
         mysqli_query($conn,$sql);
         echo '<meta http-equiv="refresh" content="0;view_feedback.php">';
        }
      }?></td>
    <td><?php echo "<a onClick=\"javascript: return confirm('Are you sure to delete this Feedback');\" href='deletefeedback.php?id=".$row['feedback_id']."'>Delete</a>"; ?></td>
       </tr>
      <?php
      }
      ?>
    </tbody>
  </table>