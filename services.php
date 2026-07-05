<?php 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Services</title>

<style>
body {
    margin:0;
    font-family: Arial, sans-serif;
    background:#fdf1f6;
}

/* Page Title */
.page-title {
    text-align:center;
    margin:30px 0;
    font-size:32px;
    color:#d81b60;
    font-weight:bold;
}

/* Service Grid */
.services-container {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap:25px;
    padding:20px 40px;
}

/* Card */
.service-card {
    background:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    transition:0.3s;
}

.service-card:hover {
    transform:translateY(-5px);
    box-shadow:0 6px 20px rgba(0,0,0,0.15);
}

.service-card h3 {
    color:#d81b60;
    margin-bottom:10px;
}

/* Button */
.service-card a {
    display:inline-block;
    margin-top:10px;
    padding:10px 20px;
    background:#d81b60;
    color:white;
    border-radius:25px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.service-card a:hover {
    background:#c2185b;
}
</style>

</head>
<body>

<h2 class="page-title">Our Services</h2>

<div class="services-container">

    <?php
    // 18 Services Array
    $services = [
        "AC Repair & Service",
        "Plumbing Service",
        "Electrician Service",
        "Home Cleaning",
        "Painting Service",
        "Pest Control",
        "Home Shifting",
        "CCTV Installation",
        "Car Wash",
        "Bike Service",
        "Carpenter",
        "Glass Cleaning",
        "Geyser Repair",
        "Water Filter Service",
        "Sofa Cleaning",
        "Kitchen Cleaning",
        "Bathroom Cleaning",
        "IT Support & Networking"
    ];

    $id = 1;
    foreach($services as $srv){
        echo "
        <div class='service-card'>
            <h3>$srv</h3>
            <a href='service_details.php?id=$id'>View Details</a>
        </div>
        ";
        $id++;
    }
    ?>

</div>

<?php include("footer.php"); ?>

</body>
</html>