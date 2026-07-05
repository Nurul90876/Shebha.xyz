<?php
// ১. একদম শুরুতে আউটপুট বাফারিং এবং সেশন স্টার্ট
ob_start(); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connect.php';

$error = "";

// ২. সেশন চেক (যদি অলরেডি লগইন থাকে)
if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; 

    // ৩. ডাটাবেজ থেকে অ্যাডমিন চেক
    $sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        
        // ৪. পাসওয়ার্ড ভেরিফিকেশন (প্লেন টেক্সট)
        if ($password === $admin['password']) {
            // সেশন ডাটা সেট করা
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_logged_in'] = true;

            // ৫. সেশন ডাটা সেভ নিশ্চিত করে রিডাইরেক্ট
            session_write_close();
            
            // জাভাস্ক্রিপ্ট রিডাইরেক্ট (যদি হেডার রিডাইরেক্ট কাজ না করে)
            echo "<script>window.location.href='admin_dashboard.php';</script>";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "❌ Wrong Password!";
        }
    } else {
        $error = "❌ Admin not found!";
    }
}
?>

<?php include("header.php"); ?>

<style>
    .login-container {
        display: flex; justify-content: center; align-items: center;
        min-height: 70vh; background: #f1f1f1; padding: 50px 0;
    }
    .login-box {
        width: 350px; background: white; padding: 25px;
        border-radius: 10px; box-shadow: 0 0 10px #999;
    }
    .login-box input {
        width: 100%; padding: 12px; margin: 10px 0;
        border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;
    }
    .login-box button {
        width: 100%; padding: 12px; background: #d6006f; color: white;
        border: none; border-radius: 5px; cursor: pointer; font-size: 16px;
    }
    .error { color: red; text-align: center; font-weight: bold; }
</style>

<div class="login-container">
    <div class="login-box">
        <h2 style="text-align: center;">Admin Login</h2>
        <?php if ($error != "") echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Admin Username" required>
            <input type="password" name="password" placeholder="Admin Password" required>
            <button type="submit" name="login">Login Now</button>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>
<?php ob_end_flush(); ?>