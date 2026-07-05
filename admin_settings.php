<?php
session_start();
// নিরাপত্তা চেক: অ্যাডমিন লগইন আছে কিনা
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// ডাটাবেজ কানেকশন
include("connect.php");
$message = "";

// পাসওয়ার্ড পরিবর্তনের লজিক
if (isset($_POST['update_password'])) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    $admin_id = $_SESSION['admin_id'];

    if ($new_pass === $confirm_pass) {
        // পাসওয়ার্ড আপডেট কুইরি
        $sql = "UPDATE admin SET password='$new_pass' WHERE admin_id=$admin_id";
        if ($conn->query($sql)) {
            $message = "<p style='color:green; font-weight:bold;'>✅ Password updated successfully!</p>";
        } else {
            $message = "<p style='color:red; font-weight:bold;'>❌ Database Error!</p>";
        }
    } else {
        $message = "<p style='color:red; font-weight:bold;'>❌ Passwords do not match!</p>";
    }
}

include("header.php");
?>

<div style="min-height: 80vh; background: #f4f7f6; padding: 50px; display: flex; justify-content: center; align-items: center;">
    <div style="width: 100%; max-width: 400px; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-align: center;">
        <h2 style="color: #d6006f; margin-bottom: 10px;">⚙️ Admin Settings</h2>
        <p style="color: #666; margin-bottom: 20px;">Change Your Login Password</p>
        <hr style="opacity: 0.2; margin-bottom: 20px;">

        <?= $message; ?>

        <form method="POST">
            <input type="password" name="new_password" placeholder="New Password" required 
                   style="width:100%; padding:12px; margin-bottom:15px; border:1px solid #ddd; border-radius:6px; box-sizing: border-box;">
            
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required 
                   style="width:100%; padding:12px; margin-bottom:20px; border:1px solid #ddd; border-radius:6px; box-sizing: border-box;">
            
            <button type="submit" name="update_password" 
                    style="width:100%; padding:12px; background:#d6006f; color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold; font-size:16px;">
                Update Password Now
            </button>
        </form>

        <div style="margin-top: 20px;">
            <a href="admin_dashboard.php" style="text-decoration:none; color:#2c3e50; font-weight:bold; font-size:14px;">
                ⬅ Back to Dashboard
            </a>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>