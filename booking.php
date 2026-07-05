<?php
ob_start(); 
include("header.php");

// DB Connection
$conn = new mysqli("localhost", "root", "", "household_service_db");
if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

// Check service_id
if (!isset($_GET['service_id'])) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Invalid Service!</h2>";
    include("footer.php");
    ob_end_flush();
    exit();
}

$service_id = intval($_GET['service_id']);

// Check if service exists
$check = $conn->query("SELECT * FROM services WHERE service_id = $service_id");
if ($check->num_rows == 0) {
    echo "<h2 style='text-align:center; margin-top:50px;'>Service Not Found!</h2>";
    include("footer.php");
    ob_end_flush();
    exit();
}

// Handle Booking Form Submit
if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $datetime = $conn->real_escape_string($_POST['datetime']);

    $sql = "INSERT INTO bookings (user_name, user_email, user_phone, service_id, booking_date, address, status)
            VALUES ('$name', '$email', '$phone', '$service_id', '$datetime', '$address', 'Pending')";

    if ($conn->query($sql)) {
        $booking_id = $conn->insert_id;
        header("Location: booking_success.php?id=" . $booking_id);
        exit();
    } else {
        echo "<h3 style='color:red; text-align:center;'>Booking Failed. Try again!</h3>";
    }
}
?>

<div style="max-width:600px; margin:60px auto; padding:30px; background:#fff;
border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.1);">

    <h2 style="color:#d81b60; text-align:center;">Booking Form</h2>

    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Email:</label>
        <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Phone:</label>
        <input type="text" name="phone" required style="width:100%; padding:10px; margin-bottom:15px;">

        <label>Address:</label>
        <textarea name="address" required style="width:100%; padding:10px; margin-bottom:15px;"></textarea>

        <label>Preferred Date & Time:</label>
        <input type="datetime-local" name="datetime" required style="width:100%; padding:10px; margin-bottom:20px;">

        <button type="submit" name="submit" 
            style="padding:12px 25px; background:#d81b60; color:white; border:none; border-radius:8px;">
            Book Now
        </button>
    </form>
</div>

<?php include("footer.php"); ?>
<?php ob_end_flush(); ?>
