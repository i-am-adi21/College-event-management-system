<?php
session_start();
$userid = $_SESSION["userid"];
$eid = $_GET["id"];
include "../dbconnect.php";


$query = "delete  FROM event_registration WHERE event_id = '$eid' and student_id = '$userid'";
$result = mysqli_query($conn, $query);
if($result)
{
    echo  "<script>alert('Event cancellation Successful .... payment amount will be Refunded within 7 business day.. Thank you ')</script>";
   $query="update event set participant_limit=participant_limit+1 where event_id = '$eid'";
   mysqli_query($conn, $query);
    echo '<meta http-equiv="refresh" content="0;events.php">';
}
else
{
echo  "<script>alert('Cancellation Failed')</script>";
}
?>