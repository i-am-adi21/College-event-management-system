<!DOCTYPE html>
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
<?php
include 'header.php';
?>
<body>
    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h3><b>REGISTRATION</b></h3>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="#" method="POST" class="comment-form contact-form"  name="reg_form" id="register">
                        <div class="row justify-content-center">
                        
                            <div class="col-lg-7">
                            <input  class="form-control" type="text" placeholder="Student Name" name="name" >
                            </div>
                            <div class="col-lg-7">
                            <table>
          <tr><td>College </td><td>
              <select name="collegeid">
                <option>-Select-</option>
                <?php
                include "dbconnect.php";
                $sql="select * from college";
                $result=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_array($result))
                {
                echo "<option value=".$row["college_id"].">".$row["college_name"]."</option>";
                }
              ?>
              </select></td></tr>
              </table></div>
            
                            <div class="col-lg-7">
                            <input  type="email" placeholder="E-mail" name="email"  >
                            </div>
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Mobile Number" name="phone" maxlength="10" onkeypress="return isNumberKey(event)"> <br>
                            </div>
                            <h6 class="col-lg-7 d-flex align-items-left">Select gender</h6>
        <div class="col-lg-7 d-flex align-items-center">
            <input type="radio" id="male" name="gender" value="male">
            <label for="male" style="margin-right: 10px;">MALE</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">FEMALE</label>
        </div>
        <div class="col-lg-7 d-flex align-items-center">
                            <h6>Date of Birth </h6><input type="date"  name="dob" max="<?php echo date('Y-m-d'); ?>"> <br>
                            </div>
                            <div class="col-lg-7 text-center">
                            <textarea  name="address" placeholder="Address"></textarea> <br>
                        </div>
                        
                        <div class="col-lg-7">
                        <input  type="password" id="password" placeholder="Password" name="password">
                        </div>
                        <div class="col-lg-7">
                        <input  name="cpassword" type="password" placeholder="Confirm Password" name="cpassword" >
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
$gender = $_POST["gender"];
$dob=$_POST["dob"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$password=$_POST["password"];
$address=$_POST["address"];
$collegeid=$_POST["collegeid"];
include "dbconnect.php";
$sql="select * from login where username='$email'";
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result))
  {
    echo "<script>alert('Email id Already registered')</script>";
  }
else
{
$sql="insert into login(username,password,usertype) values('$email','$password','student')";
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
  $sql="insert into student(student_id,student_name,email,gender,dob,phone,address,college_id) values('$id','$name','$email','$gender','$dob','$phone','$address','$collegeid')";
    
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