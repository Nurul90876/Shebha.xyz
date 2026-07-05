<?php 
// registration.php

// Include header
include("header.php"); 

// Database connection
$conn = new mysqli("localhost", "root", "", "household_service_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$success_msg = $error_msg = "";
if(isset($_POST['register'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password !== $confirm_password){
        $error_msg = "Password and Confirm Password do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, phone, password)
                VALUES ('$name','$email','$phone','$hashed_password')";
        if($conn->query($sql)){
            $success_msg = "Registration successful! You can <a href='login.php'>login</a> now.";
        } else {
            $error_msg = "Error: " . $conn->error;
        }
    }
}
?>

<!-- Registration form HTML -->
<div style="padding:120px 20px 50px;"> <!-- padding top for sticky header -->
    <div style="max-width:400px; margin:0 auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
        <h2 style="text-align:center; color:#d81b60;">Create Account</h2>

        <?php if($success_msg){ echo "<p style='color:green; text-align:center;'>$success_msg</p>"; } ?>
        <?php if($error_msg){ echo "<p style='color:red; text-align:center;'>$error_msg</p>"; } ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required style="width:100%; padding:12px; margin-bottom:15px; border-radius:5px; border:1px solid #ddd;">
            <input type="email" name="email" placeholder="Email Address" required style="width:100%; padding:12px; margin-bottom:15px; border-radius:5px; border:1px solid #ddd;">
            <input type="text" name="phone" placeholder="Phone Number" required style="width:100%; padding:12px; margin-bottom:15px; border-radius:5px; border:1px solid #ddd;">
            <input type="password" name="password" placeholder="Password" required style="width:100%; padding:12px; margin-bottom:15px; border-radius:5px; border:1px solid #ddd;">
            <input type="password" name="confirm_password" placeholder="Confirm Password" required style="width:100%; padding:12px; margin-bottom:15px; border-radius:5px; border:1px solid #ddd;">
            <button type="submit" name="register" style="width:100%; padding:12px; background:#d81b60; color:white; border:none; border-radius:5px; cursor:pointer;">Register</button>
        </form>

        <p style="text-align:center; margin-top:15px;">
            Already have an account? <a href="login.php" style="color:#d81b60;">Login here</a>
        </p>
    </div>
</div>

<?php 
// Include footer
include("footer.php"); 
?>
