<!DOCTYPE html>
<?php
include 'header.php';
session_start();
?>

    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h1><b>EVENT REGISTRATION</b></h1>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Event Name" name="name" >
                            </div>
                            <div class="col-lg-7">
                            <table>
          <tr><td>Category</td><td>
              <select name="categoryid">
                <option>-Select-</option>
                <?php
                include "../dbconnect.php";
                $sql="select * from category";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result))
                {
                echo "<option value=".$row["cat_id"].">".$row["cat_name"]."</option>";
                }
              ?>
              </select></td></tr>
              </table></div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Venue" name="venue" >
                            </div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Contact" name="phone" maxlength="10" > <br>
                            </div>
                
                            <div class="col-lg-7 text-center">
                            <textarea  name="description" placeholder="description"></textarea> <br>
                        </div>
                        <div class="col-lg-7">
                        <h6>Date - time</h6><input type="datetime-local"  name="date">
                        </div>
                        <div class="col-lg-7">
                            <input  type="text" placeholder="Participant Limit" name="ptl" > 
                          </div>                            
                        <div class="col-lg-7">
                        Upload Image: <input type="file" name="fileToUpload" id="fileToUpload"accept="image/*" onchange="loadFile(event)">
          <img id="output" width=200px/></td></tr>
                        </div>
                        
                      </div>
                        <div class="flex justify-content-center">
                                <input class="primary-btns" type="submit" value="Register" name="submit"></div>
                            
                        
                    </form>
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

  $sql="insert into event(event_name,venue,description,contact,date,category_id,event_img,participant_limit,college_id)values('$name','$venue','$description','$phone','$date','$catid','$filename','$participant','$cid')";
    
    $result=mysqli_query($conn,$sql);
    if($result)
    echo "<script>alert('Successfully Registered')</script>";
else
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