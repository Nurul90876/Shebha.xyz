<?php
// ১. সেশন এবং ডাটাবেজ কানেকশন সবার আগে থাকবে
session_start();
if(!isset($_SESSION['admin_logged_in'])){ header("Location: admin_login.php"); exit(); }
include("connect.php");

// ২. স্ট্যাটাস আপডেট করার লজিক (হেডার ইনক্লুড করার আগে এটি সম্পন্ন করতে হবে)
if(isset($_GET['id']) && isset($_GET['status'])){
    $id = intval($_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    
    // ডাটাবেজ আপডেট
    $conn->query("UPDATE bookings SET status='$status' WHERE booking_id=$id");
    
    // আপডেট শেষে রিডাইরেক্ট (এটি ব্রাউজারে কোনো আউটপুট যাওয়ার আগে হতে হবে)
    header("Location: manage_bookings.php");
    exit();
}

// ৩. সব লজিক শেষ হলে এখন হেডার ইনক্লুড করুন
include("header.php");
?>

<div style="display: flex; min-height: 80vh;">
    <div style="flex: 1; padding: 30px; background: #f4f7f6;">
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="color: #d6006f; margin: 0;">📅 Manage Bookings</h2>
                
                <a href="admin_dashboard.php" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;">
                    ⬅ Back to Dashboard
                </a>
            </div>
            
            <hr>

            <table border="1" width="100%" style="border-collapse: collapse; margin-top: 20px; font-family: sans-serif;">
                <thead>
                    <tr style="background: #f8f9fa; height: 45px; color: #333;">
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Service Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ডাটাবেজ থেকে বুকিং লিস্ট আনা
                    $sql = "SELECT b.booking_id, b.user_name, b.booking_date, b.status, s.service_name 
                            FROM bookings b 
                            LEFT JOIN services s ON b.service_id = s.service_id 
                            ORDER BY b.booking_id DESC";
                    
                    $res = $conn->query($sql);
                    if($res && $res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            $statusColor = ($row['status'] == 'Confirmed') ? '#27ae60' : '#f39c12';
                    ?>
                    <tr style="height: 45px; text-align: center; border-bottom: 1px solid #eee;">
                        <td><?= $row['booking_id']; ?></td>
                        <td><?= htmlspecialchars($row['user_name']); ?></td>
                        <td><?= htmlspecialchars($row['service_name']); ?></td>
                        <td><?= $row['booking_date']; ?></td>
                        <td style="color: <?= $statusColor; ?>; font-weight: bold;"><?= $row['status']; ?></td>
                        <td>
                            <a href="?id=<?= $row['booking_id']; ?>&status=Confirmed" style="color: #27ae60; text-decoration: none; margin-right: 10px; font-weight: bold;">✅ Confirm</a>
                            <a href="?id=<?= $row['booking_id']; ?>&status=Pending" style="color: #e67e22; text-decoration: none; font-weight: bold;">⏳ Pending</a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='6' style='padding: 20px;'>No bookings found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>