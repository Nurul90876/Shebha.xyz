<?php
session_start();
// ১. সেশন চেক করা
if(!isset($_SESSION['admin_logged_in'])){ header("Location: admin_login.php"); exit(); }
include("connect.php"); // ডাটাবেজ কানেকশন
include("header.php");
?>

<div style="display: flex; min-height: 80vh;">
    <div style="flex: 1; padding: 30px; background: #f4f7f6;">
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #d6006f; margin: 0;">👥 Registered Users</h2>
                <a href="admin_dashboard.php" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">
                    ⬅ Back to Dashboard
                </a>
            </div>
            
            <hr>

            <table border="1" width="100%" style="border-collapse: collapse; margin-top: 20px; text-align: center; font-family: sans-serif;">
                <thead>
                    <tr style="background: #f8f9fa; height: 40px; color: #333;">
                        <th>User ID</th>
                        <th>Name</th> <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ডাটাবেজ থেকে ডেটা আনা (কলামের নাম 'name' হিসেবে ধরা হয়েছে)
                    $res = $conn->query("SELECT * FROM users ORDER BY user_id DESC");
                    
                    if($res && $res->num_rows > 0) {
                        while($row = $res->fetch_assoc()){
                            echo "<tr style='height: 40px; border-bottom: 1px solid #eee;'>
                                <td>" . $row['user_id'] . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td> <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='padding: 20px;'>No users found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>