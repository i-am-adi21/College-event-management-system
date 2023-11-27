<!DOCTYPE html>
<?php
include 'header.php';
session_start();
$id=$_GET["id"];
include "../dbconnect.php";
?>

    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h1><b>MANAGE EVENT</b></h1>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                        <?php $sql="select * from event where event_id='$id'";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result))
  { ?>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Event Name" name="name" value=<?php echo $row["event_name"]; ?> >
                            </div>
                            <div class="col-lg-7">
                            <table>
          <tr><td>Category</td><td>
              <select name="categoryid">
                <option>-Select-</option>
                <?php
                include "../dbconnect.php";
                $sql1="select * from category";
                $result1=mysqli_query($conn,$sql1);
                while($row1=mysqli_fetch_array($result1))
                {
                echo "<option value=".$row1["cat_id"].">".$row1["cat_name"]."</option>";
                }
              
              ?>
              </select></td></tr>
              </table></div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Venue" name="venue" value=<?php echo $row["venue"]; ?>>
                            </div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Contact" name="phone" maxlength="10" value=<?php echo $row["contact"]; ?>> <br>
                            </div>
                
                            <div class="col-lg-7 text-center">
                            <textarea  name="description" placeholder="description" value=<?php echo $row["description"]; ?>><?php echo $row["description"]; ?></textarea> <br>
                        </div>
                        <div class="col-lg-7">
                        
                        <?php
                        $mysql_datetime=$row["date"]; 
                        $datetime = new DateTime($mysql_datetime);
$html5_datetime = $datetime->format('Y-m-d\TH:i:s.u');
?>

                        <h6>Date - time</h6><input type="datetime-local"  name="date" value='<?php echo $html5_datetime; ?>'>
                        </div>
                        <div class="col-lg-7">
                            <input  type="text" placeholder="Participant Limit" name="ptl" value=<?php echo $row["participant_limit"]; ?>> 
                          </div>                            
                        <div class="col-lg-7">
                        Upload Image: <input type="file" name="fileToUpload" id="fileToUpload"accept="image/*" onchange="loadFile(event)">
          <img id="output" width=200px/></td></tr>
                        </div>
                        
                      </div>
                        <div class="flex justify-content-center">
                                <input class="primary-btns" type="submit" value="submit" name="submit"></div>
                            
                        
                    </form>
                    <?php } ?>
                    <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
  };
</script>
                    <?php

if(isset($_POST["submit"]))
{
  
$cid=$_SESSION['userid'];
echo $cid;
$name=$_POST["name"];
$catid=$_POST["categoryid"];
$phone=$_POST["phone"];
$venue=$_POST["venue"];
$description=$_POST["description"];
//$cid=$_SESSION["userid"];
$participant=$_POST["ptl"];
$datetimeLocal=$_POST["date"];
$date= date('Y-m-d H:i:s', strtotime($datetimeLocal));

$target_dir= "../uploads/";
$filename=basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". $filename . " has been uploaded.";
}
include "../dbconnect.php";

  $sql="update event set event_name='$name',venue='$venue',description='$description',contact='$phone',date='$date',category_id='$catid',event_img='$filename',participant_limit='$participant',college_id='$cid' where event_id='$id'";
    echo $sql;
    $result=mysqli_query($conn,$sql);
    if($result)
    {
    echo "<script>alert('Successfully updated')</script>";
    echo '<meta http-equiv="refresh" content="0;event.php">';
    }else
    echo "<script>alert('Registration failed')";
}

?>
                
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->

    <?php
    include 'footer.php'
  ?>