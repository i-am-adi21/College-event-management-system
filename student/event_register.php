<?php
session_start();
$userid = $_SESSION["userid"];
$eid = $_GET["id"];
include "../dbconnect.php";


$query = "SELECT event_name FROM event WHERE event_id = $eid";
$result = mysqli_query($conn, $query);
$event_name = mysqli_fetch_assoc($result)['event_name'];


$last_reg_id = "";
$query = "SELECT token FROM event_registration WHERE token LIKE '$event_name%' ORDER BY token DESC LIMIT 1";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $last_reg_id = mysqli_fetch_assoc($result)['token'];
}


$last_digits = substr($last_reg_id, -6);
if(!is_numeric($last_digits)) {
    $last_digits = 0;
}
$next_digits = str_pad(intval($last_digits) + 1, 6, '0', STR_PAD_LEFT);
$event_register_id = $event_name . $next_digits;

echo $event_register_id;
$query = "SELECT token FROM event_registration WHERE token = '$event_register_id'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $next_digits = str_pad(intval($last_digits) + 2, 6, '0', STR_PAD_LEFT);
    $event_register_id = $event_name . $next_digits;
}




$sql="select * from event_registration where student_id='$userid' and event_id='$eid'";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1)
	{
       
        $status=mysqli_fetch_assoc($result)['status'];
        $result=mysqli_query($conn,$sql);
        $reg_id=mysqli_fetch_assoc($result)['reg_id'];
        echo "<script>alert('Booking Already done')</script>";
        if($status=='pending_payment')
        {
            $_SESSION["rid"]=$reg_id;
        echo '<meta http-equiv="refresh" content="0;payment/payment.php">';
        }
        else if($status=='paid')
        {
            echo  "<script>alert('Event registration and payment is done')</script>";
            echo '<meta http-equiv="refresh" content="0;index.php">';
        }
    }
else
{

$sql="insert into event_registration(student_id,event_id,status,date,token) values('$userid','$eid','pending_payment',curdate(),'$event_register_id')";
//echo $sql;
$result=mysqli_query($conn,$sql);
if($result)
{
echo "<script>alert('Booking Successfull and your Booking Token is $event_register_id')</script>";
}
$sql="select max(reg_id) as reg_id from event_registration" ;
//echo $sql;
$result=mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result))
$_SESSION["rid"]=$row["reg_id"];
$sql1="update event set participant_limit=participant_limit-1 where event_id='$eid'";
mysqli_query($conn,$sql1);
echo '<meta http-equiv="refresh" content="0;payment/payment.php">';
}
?>