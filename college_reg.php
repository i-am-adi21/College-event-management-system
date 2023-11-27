<html>
      <form action="" method="POST">
      <input  type="text" placeholder="College Name" name="cname" > <br>
      <input  type="email" placeholder="E-mail" name="email" >
      <input  type="text" placeholder="Contact Number" name="phone" maxlength="10" onkeypress="return isNumberKey(event)"> <br>
      <textarea  name="address" placeholder="Address"></textarea> <br>
      <input  type="password" id="password" placeholder="Password" name="password">
      <br>
    <input  name="cpassword" type="password" placeholder="Confirm Password" >
    <input type="submit" value="register" name="submit" >         
      </form>
 <?php

if(isset($_POST["submit"]))
{
$name=$_POST["cname"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$password=$_POST["password"];
$address=$_POST["address"];
include "dbconnect.php";
$sql="select * from login where username='$email'";
$result=mysqli_query($con,$sql);
if($row=mysqli_fetch_array($result))
  {
    echo "<script>alert('Email id Already registered')</script>";
  }
else
{
$sql="insert into login(username,password,usertype) values('$email','$password','student')";
$result=mysqli_query($con,$sql);
$id=0;
if($result)
{
  $sql="select max(login_id) as id  from login";
  $result=mysqli_query($con,$sql);
  while($row=mysqli_fetch_array($result))
  {
    $id=$row["id"];
  }
  $sql="insert into student(student_id,student_name,email,gender,dob,phone,address) values('$id','$name','$email','$gender','$dob','$phone','$address')";
    
    $result=mysqli_query($con,$sql);
    echo "<script>alert('Successfully Registered')</script>";
}

else
    echo "<script>alert('Registration failed')";
}
}
?>
</html>