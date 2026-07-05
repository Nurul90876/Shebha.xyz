<?php
session_start();

// নিরাপত্তা চেক
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// লগআউট লজিক
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

// DB Connection
include("connect.php");
date_default_timezone_set('Asia/Dhaka'); 

/* DASHBOARD COUNTS */
$total_services = $conn->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$total_bookings = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$pending_bookings = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status='Pending'")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];

/* ডায়নামিক চার্ট কুয়েরি */
$chart_query = $conn->query("
    SELECT DATE(booking_date) as day, COUNT(*) as total 
    FROM bookings 
    GROUP BY DATE(booking_date) 
    ORDER BY day ASC LIMIT 7
");

$days = [];
$counts = [];
while($row = $chart_query->fetch_assoc()){
    $days[] = date("D", strtotime($row['day'])); 
    $counts[] = $row['total']; 
}
if(empty($days)){ $days = ['No Data']; $counts = [0]; }

/* RECENT ACTIVITY - ডাটাবেজ এরর সমাধান */
// পেমেন্ট ডাটা: আপনার টেবিলে id নেই, তাই transaction_id ব্যবহার করা হয়েছে
$recent_paints = $conn->query("
    SELECT t.transaction_id as id, p.method as title, t.created_at as time, 'payment' as type 
    FROM transactions t 
    JOIN payments p ON t.payment_id = p.payment_id 
    ORDER BY t.transaction_id DESC LIMIT 3
");

// ইউজার ডাটা: আপনার টেবিলে username না থাকলে user_id বা অন্য কলাম ব্যবহার করুন
// আমি এখানে user_id এবং 'New User' দেখাচ্ছি যাতে এরর না আসে
$recent_users = $conn->query("
    SELECT user_id as id, created_at as time, 'user' as type 
    FROM users 
    ORDER BY user_id DESC LIMIT 2
");
?>

<?php include("header.php"); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
.admin-container{ display:flex; min-height:100vh; background:#f0f2f5; }
.sidebar{ width:260px; background:#1e293b; color:white; padding:25px 15px; position: sticky; top: 0; height: 100vh; }
.sidebar h2{ font-size: 22px; text-align: center; margin-bottom: 30px; color: #38bdf8; }
.sidebar a{ color:#cbd5e1; text-decoration:none; display:flex; align-items: center; padding:12px 15px; border-radius: 8px; margin-bottom: 5px; transition: 0.3s; }
.sidebar a i{ margin-right: 12px; width: 20px; text-align: center; }
.sidebar a:hover, .sidebar a.active{ background: #334155; color: white; transform: translateX(5px); }
.main-content{ flex:1; padding:30px; }
.stats{ display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:25px; margin-top:20px; }
.stat-box{ background:white; padding:25px; border-radius:15px; box-shadow:0 4px 20px rgba(0,0,0,0.05); display: flex; align-items: center; border: 1px solid #e2e8f0; transition: 0.3s; }
.stat-box:hover{ transform: translateY(-5px); border-color: #d6006f; }
.stat-icon{ width: 55px; height: 55px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-right: 20px; }
.stat-info h2{ margin:0; color:#1e293b; font-size:28px; line-height: 1; }
.stat-info p{ margin: 5px 0 0 0; color:#64748b; font-size: 14px; font-weight: 500; }
.dashboard-grid{ display: grid; grid-template-columns: 2fr 1.2fr; gap: 25px; margin-top: 30px; }
.chart-container, .recent-activity{ background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
.section-title{ font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; display: flex; align-items: center; }
.section-title i{ margin-right: 10px; color: #d6006f; }
.recent-list{ list-style: none; padding: 0; }
.recent-item{ display: flex; align-items: center; padding: 15px 0; border-bottom: 1px solid #f1f5f9; transition: 0.2s; }
.user-avatar{ width: 45px; height: 45px; border-radius: 12px; margin-right: 15px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.time-badge { font-size: 11px; color: #94a3b8; display: block; margin-top: 2px; }
.activity-text { font-size: 14px; color: #334155; margin: 0; }
</style>

<div class="admin-container">
    <div class="sidebar">
        <h2><i class="fas fa-user-shield"></i> Admin Panel</h2>
        <a href="admin_dashboard.php" class="active"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="manage_services.php"><i class="fas fa-tools"></i> Manage Services</a>
        <a href="manage_bookings.php"><i class="fas fa-box"></i> Manage Bookings</a>
        <a href="manage_users.php"><i class="fas fa-users"></i> Manage Users</a>
        <a href="admin_reports.php"><i class="fas fa-chart-line"></i> Full Reports</a>
        <a href="admin_settings.php"><i class="fas fa-cog"></i> Admin Settings</a>
        <hr style="border: 0.5px solid #334155; margin: 20px 0;">
        <a href="index.php"><i class="fas fa-home"></i> Back to Home</a>
        <a href="?logout=true" style="color:#fb7185;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="margin: 0; font-size: 24px; color: #1e293b;">Welcome, <?= $_SESSION['admin_username'] ?? 'Admin'; ?>!</h1>
                <p style="color: #64748b; margin: 5px 0 0 0;">Daily statistics overview.</p>
            </div>
            <div id="real-time-clock" style="background: white; padding: 10px 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); font-weight: bold; color: #1e293b;">
                <i class="far fa-clock"></i> Loading...
            </div>
        </div>

        <div class="stats">
            <div class="stat-box">
                <div class="stat-icon" style="background: rgba(56, 189, 248, 0.1); color: #0ea5e9;"><i class="fas fa-briefcase"></i></div>
                <div class="stat-info"><h2><?= $total_services ?></h2><p>Services</p></div>
            </div>
            <div class="stat-box">
                <div class="stat-icon" style="background: rgba(214, 0, 111, 0.1); color: #d6006f;"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-info"><h2><?= $total_bookings ?></h2><p>Bookings</p></div>
            </div>
            <div class="stat-box" style="border-left: 5px solid #f59e0b;">
                <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;"><i class="fas fa-clock"></i></div>
                <div class="stat-info"><h2><?= $pending_bookings ?></h2><p>Pending</p></div>
            </div>
            <div class="stat-box">
                <div class="stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;"><i class="fas fa-user-friends"></i></div>
                <div class="stat-info"><h2><?= $total_users ?></h2><p>Users</p></div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="chart-container">
                <div class="section-title"><i class="fas fa-chart-area"></i> Last 7 Days Analytics</div>
                <canvas id="bookingChart" height="250"></canvas>
            </div>

            <div class="recent-activity">
                <div class="section-title"><i class="fas fa-history"></i> Recent Activity</div>
                <div class="recent-list">
                    <?php while($user = $recent_users->fetch_assoc()): ?>
                    <div class="recent-item">
                        <div class="user-avatar" style="background: #e0f2fe; color: #0369a1;"><i class="fas fa-user-plus"></i></div>
                        <div>
                            <p class="activity-text"><b>New User ID: <?= $user['id'] ?></b> registered</p>
                            <span class="time-badge"><?= date("h:i A", strtotime($user['time'])) ?> • System Alert</span>
                        </div>
                    </div>
                    <?php endwhile; ?>

                    <?php while($pay = $recent_paints->fetch_assoc()): ?>
                    <div class="recent-item">
                        <div class="user-avatar" style="background: #fdf2f7; color: #d6006f;"><i class="fas fa-receipt"></i></div>
                        <div>
                            <p class="activity-text"><b><?= ucfirst($pay['title']) ?></b> payment completed</p>
                            <span class="time-badge"><?= date("h:i A", strtotime($pay['time'])) ?> • Txn ID: <?= $pay['id'] ?></span>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateClock() {
    const now = new Date();
    const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    document.getElementById('real-time-clock').innerHTML = '<i class="far fa-clock"></i> ' + now.toLocaleDateString('en-US', options);
}
setInterval(updateClock, 1000);
updateClock();

const ctx = document.getElementById('bookingChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($days) ?>,
        datasets: [{
            label: 'Bookings',
            data: <?= json_encode($counts) ?>,
            borderColor: '#d6006f',
            backgroundColor: 'rgba(214, 0, 111, 0.1)',
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointBackgroundColor: '#d6006f',
            pointRadius: 5
        }]
    }
});
</script>

<?php include("footer.php"); ?>