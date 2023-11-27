<?php
// start session
session_start();

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // redirect to login page
  header('Location: login.php');
  exit();
}
include "../dbconnect.php";
// get user details
$user_id = $_SESSION['userid'];
$query = "SELECT * FROM login WHERE login_id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_row($result);

// check if form was submitted
if (isset($_POST['submit'])) {
  // get form data
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // validate form data
  $errors = array();
  if (empty($old_password)) {
    $errors['old_password'] = 'Old password is required';
  }
  if (empty($new_password)) {
    $errors['new_password'] = 'New password is required';
  }
  if (empty($confirm_password)) {
    $errors['confirm_password'] = 'Confirm password is required';
  }
  if ($new_password != $confirm_password) {
    $errors['confirm_password'] = 'Passwords do not match';
  }

  // check if old password is correct
  $hash = $user['password'];
  if (!password_verify($old_password, $hash)) {
    $errors['old_password'] = 'Incorrect password';
  }

  // update password if no errors
  if (count($errors) == 0) {
    $hash = password_hash($new_password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$hash' WHERE id = $user_id";
    mysqli_query($conn, $query);
    $success = 'Password updated successfully';
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
</head>
<body>
  <h1>Welcome, <?php echo $user['name']; ?>!</h1>
  <p>Email: <?php echo $user['email']; ?></p>
  <h2>Change Password</h2>
  <?php if (isset($success)): ?>
    <p style="color: green;"><?php echo $success; ?></p>
  <?php endif; ?>
  <form method="post">
    <div>
      <label for="old_password">Old Password:</label>
      <input type="password" name="old_password" id="old_password" required>
      <?php if (isset($errors['old_password'])): ?>
        <p style="color: red;"><?php echo $errors['old_password']; ?></p>
      <?php endif; ?>
    </div>
    <div>
      <label for="new_password">New Password:</label>
      <input type="password" name="new_password" id="new_password" required>
      <?php if (isset($errors['new_password'])): ?>
        <p style="color: red;"><?php echo $errors['new_password']; ?></p>
      <?php endif; ?>
    </div>
    <div>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" id="confirm_password" required>
      <?php if (isset($errors['confirm_password'])): ?>
        <p style="color: red;"><?php echo $errors['confirm_password']; ?></p>
      <?php endif; ?>
    
