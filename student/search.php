<?php
include "header.php";
include "../dbconnect.php";
$search_query = $_GET['search_query'];
if(isset($_GET['s1']))
{
    $sql = "SELECT * FROM event WHERE event_name LIKE '%$search_query%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<p>search results of '$search_query'......</p>";
    while($row = $result->fetch_assoc()) {
        ?>
        <table>
        <img src="<?php echo "../uploads/".$row['event_img']?>" width="300px" height="300px">
        <tr><th><h3><b><?php echo $row['event_name'];?></b></h3></th></tr>
        <tr><th><img href="/../uploads/<?php echo $row['event_img']?>"></th></tr>
        <tr><th>Description</th><td><?php echo $row['description'];?></td></tr>
        <tr><th>Participants:</th><td><?php echo $row['participant_limit'];?></td></tr>
        <tr><th><a href="event_register.php?id=<?php echo $row['event_id'];?>">Register</a></th></tr>
    </table><?php
    }
  } else {
    echo "No results found.";
  }
}
