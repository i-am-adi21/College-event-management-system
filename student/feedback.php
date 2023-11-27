<!DOCTYPE html>
<?php
include 'header.php';
?>

    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h3><b>ADD Feedback</b></h3>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                            <input  type="text" placeholder="feedback" name="feedback" >
                            </div>
                            
                      </div>
                        <div class="flex justify-content-center" >
                                <input class="primary-btns" type="submit" value="ADD" name="submit"></div>
                            
                        
                    </form>
                
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->
    <?php
    session_start();
if(isset($_POST["submit"]))
{
$feedback=$_POST["feedback"];
$user_id=$_SESSION["userid"];

    include '../dbconnect.php';
    $sql="insert into feedback(feedback,user_id) values('$feedback','$user_id')";
    $result=mysqli_query($conn,$sql);
    if($result) {  
    echo "<script>alert('Successfully Inserted')</script>";
    header("Location: index.php");
  } else {
    echo "Sorry, there was an error at inserting.";
  }
}

?>

    <?php
    include 'footer.php'
    ?>