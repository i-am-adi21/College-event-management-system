<!DOCTYPE html>
<?php
include 'header.php';
?>
<script src="js/validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
<style>
    .error{
        color: red;
        font-style: italic;
        
    } 
    </style>
<body>
    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h1><b>COLLEGE REGISTRATION</b></h1>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form" name="reg_form" id="register">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                            <input  type="text" placeholder="College Name" name="name" >
                            </div>
                            <div class="col-lg-7">
                            <input  type="email" placeholder="E-mail" name="email" >
                            </div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Mobile Number" name="phone" maxlength="10" > <br>
                            </div>
                
                            <div class="col-lg-7 text-center">
                            <textarea  name="address" placeholder="Address"></textarea> <br>
                        </div>
                        <div class="col-lg-7">
                        <input  type="password" id="password" placeholder="Password" name="password">
                        </div>
                        <div class="col-lg-7">
                        <input  name="cpassword" type="password" placeholder="Confirm Password" >
                        </div>
                      </div>
                        <div class="flex justify-content-center">
                                <input class="primary-btns" type="submit" value="Register" name="submit"></div>
                            
                        
                    </form>
                    <script src="js/validate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"></script>
</body>
                    <?php

if(isset($_POST["submit"]))
{
$name=$_POST["name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$password=$_POST["password"];
$address=$_POST["address"];
include "dbconnect.php";
$sql="select * from login where username='$email'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result))
  {
    echo "<script>alert('Email id Already registered')</script>";
  }
else
{
$sql="insert into login(username,password,usertype) values('$email','$password','college')";
$result=mysqli_query($conn,$sql);
$id=0;
if($result)
{
  $sql="select max(login_id) as id  from login";
  $result=mysqli_query($conn,$sql);
  while($row=mysqli_fetch_array($result))
  {
    $id=$row["id"];
  }
  $sql="insert into college(college_id,college_name,email,contact,address)values('$id','$name','$email','$phone','$address')";
    
    $result=mysqli_query($conn,$sql);
    echo "<script>alert('Successfully Registered')</script>";

}

else
    echo "<script>alert('Registration failed')";
}
}
?>
                
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->

    <?php
    include 'footer.php'
    ?>