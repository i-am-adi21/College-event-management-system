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
                    <h3><b>ADD Category</b></h3>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Category Name" name="cat_name" >
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
if(isset($_POST["submit"]))
{
$catname=$_POST["cat_name"];

    include 'dbconnect.php';
    $sql="insert into category(cat_name) values('$catname')";
    $result=mysqli_query($conn,$sql);
    if($result) {  
    echo "<script>alert('Successfully Inserted')</script>";
    header("Location: category.php");
  } else {
    echo "Sorry, there was an error at inserting.";
  }
}

?>

    <?php
    include 'footer.php'
    ?>