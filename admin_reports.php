<?php
session_start();
// নিরাপত্তা চেক
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

include("connect.php");
include("header.php");

// গ্রাফের জন্য ডেটা আনা
$pending_count = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status='Pending'")->fetch_assoc()['total'] ?? 0;
$confirmed_count = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status='Confirmed'")->fetch_assoc()['total'] ?? 0;
$completed_count = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status='Completed'")->fetch_assoc()['total'] ?? 0;

$total_services = $conn->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawCharts);

  function drawCharts() {
    // Pie Chart
    var pieData = google.visualization.arrayToDataTable([
      ['Status', 'Count'],
      ['Pending',     <?= $pending_count ?>],
      ['Confirmed',   <?= $confirmed_count ?>],
      ['Completed',   <?= $completed_count ?>]
    ]);

    var pieOptions = {
      title: 'Overall Booking Status',
      pieHole: 0.4,
      colors: ['#f39c12', '#3498db', '#27ae60']
    };

    var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
    pieChart.draw(pieData, pieOptions);

    // Bar Chart
    var barData = google.visualization.arrayToDataTable([
      ['Category', 'Total'],
      ['Services', <?= $total_services ?>],
      ['Users', <?= $total_users ?>]
    ]);

    var barOptions = {
      title: 'Platform Overview',
      colors: ['#d6006f'],
      legend: { position: "none" }
    };

    var barChart = new google.visualization.ColumnChart(document.getElementById('bar_chart_div'));
    barChart.draw(barData, barOptions);
  }
</script>

<div style="min-height: 80vh; background: #f4f7f6; padding: 30px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="color: #2c3e50; margin: 0;">📊 Statistics & Analytics</h2>
            <a href="admin_dashboard.php" style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">⬅ Back to Dashboard</a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <div id="pie_chart_div" style="width: 100%; height: 400px;"></div>
            </div>

            <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <div id="bar_chart_div" style="width: 100%; height: 400px;"></div>
            </div>
        </div>

    </div>
</div>

<?php include("footer.php"); ?>