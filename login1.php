<!DOCTYPE html>
<?php
include 'header.php';
?>
                    <?php
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    // Get values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['userid'] = $row['login_id'];
        $user_type = $row['usertype'];

        if ($user_type == 'student') 
        {
            header("Location: student/index.php");
        } elseif ($user_type == 'college') 
        {
            header("Location: college/index.php");
        }
        elseif ($user_type == 'admin')
        {
          header("Location: admin/index.php");
        }
    } else {
        // Show an error message if the login failed
        echo "Login failed. Please check your username and password.";
    }
}
?>


    <!-- Contact Form Section Begin -->
    <section class="contact-from-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                    <h1><b>LOGIN</b></h1>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="POST" class="comment-form contact-form">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-7">
                            <input  type="text" placeholder="Username" name="username" >
                            </div>
                            
                        <div class="col-lg-7">
                        <input  type="password" id="password" placeholder="Password" name="password">
                        </div>
                      
                      </div>
                        <div class="flex justify-content-center" >
                                <input class="primary-btns" type="submit" value="LOGIN" name="submit"></div>
                            
                        
                    </form>

                
            </div>
        </div>
    </section>
    <!-- Contact Form Section End -->

    <?php
    include 'footer.php'
    ?>