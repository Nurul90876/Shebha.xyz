<?php
session_start();  // session must start at the top

$conn = new mysqli("localhost", "root", "", "household_service_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$error_msg = "";
if(isset($_POST['login'])){
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: services.php");  // redirect after login
            exit();
        } else {
            $error_msg = "Invalid password!";
        }
    } else {
        $error_msg = "Email not found!";
    }
}
include("header.php");
?>

<div style="display:flex; justify-content:center; align-items:center; min-height:80vh; background:#f5f5f5;">
    <div style="background:white; padding:40px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.1); width:100%; max-width:400px; text-align:center;">
        <h2 style="color:#d81b60;">Login to Sheba</h2>
        <?php if($error_msg) echo "<p style='color:red;'>$error_msg</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required style="width:100%; padding:12px; margin-bottom:15px;">
            <input type="password" name="password" placeholder="Password" required style="width:100%; padding:12px; margin-bottom:15px;">
            <button type="submit" name="login" style="width:100%; padding:12px; background:#d81b60; color:white; border:none;">Login</button>
        </form>
        <p style="margin-top:10px;">Don't have an account? <a href="registration.php" style="color:#d81b60;">Register here</a></p>
    </div>
</div>

<?php include("footer.php"); ?>
