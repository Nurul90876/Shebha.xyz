<?php
ob_start();
session_start();
include("header.php");

// DB Connection
$conn = new mysqli("localhost", "root", "", "household_service_db");
if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Check booking_id
if (!isset($_GET['id'])) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Invalid Booking!</h2>";
    include("footer.php");
    ob_end_flush();
    exit();
}

$booking_id = intval($_GET['id']);

// Fetch booking + service name
$sql = "SELECT b.*, s.service_name 
        FROM bookings b
        LEFT JOIN services s ON b.service_id = s.service_id
        WHERE b.booking_id = $booking_id";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Booking Not Found!</h2>";
    include("footer.php");
    ob_end_flush();
    exit();
}

$booking = $result->fetch_assoc();
?>

<div style="max-width:700px; margin:60px auto; padding:40px; background:#fff; 
border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.1); text-align:center; font-family: Arial, sans-serif;">

    <div style="font-size: 60px; color: #27ae60; margin-bottom: 20px;">✅</div>
    <h2 style="color:#d81b60; margin-bottom: 20px;">Booking Confirmed!</h2>
    <p style="color: #666; margin-bottom: 30px;">Thank you for your booking. Our team will contact you soon.</p>

    <div style="text-align: left; background: #f9f9f9; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
        <p><strong>Booking ID:</strong> <?= $booking['booking_id']; ?></p>
        <p><strong>Service:</strong> <?= $booking['service_name']; ?></p>
        <p><strong>Name:</strong> <?= $booking['user_name']; ?></p>
        <p><strong>Email:</strong> <?= $booking['user_email']; ?></p>
        <p><strong>Phone:</strong> <?= $booking['user_phone']; ?></p>
        <p><strong>Address:</strong> <?= $booking['address']; ?></p>
        <p><strong>Booking Date:</strong> <?= $booking['booking_date']; ?></p>
        <p><strong>Status:</strong> <span style="color: #d81b60; font-weight: bold;"><?= $booking['status']; ?></span></p>
    </div>

    <a href="index.php" style="display: inline-block; padding: 12px 30px; background: #2c3e50; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; transition: 0.3s;">
        🏠 Back to Home
    </a>

</div>

<?php include("footer.php"); ?>
<?php ob_end_flush(); ?>