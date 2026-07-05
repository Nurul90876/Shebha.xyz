<?php 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Service Details</title>

<style>
body {
    margin:0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background:#f4f7f6;
}

/* Modal Style Container */
.details-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
    padding: 20px;
}

.details-box {
    max-width: 600px;
    width: 100%;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    position: relative;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Close Button (Icon) */
.close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 24px;
    color: #333;
    text-decoration: none;
    font-weight: bold;
    z-index: 10;
}

.service-banner {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.content-area {
    padding: 30px;
    text-align: center;
}

.service-title {
    color: #d81b60;
    font-size: 28px;
    margin: 0 0 15px 0;
}

.price-pill {
    display: inline-block;
    background: #d81b60;
    color: white;
    padding: 8px 25px;
    border-radius: 50px;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 20px;
}

.description {
    color: #555;
    font-size: 16px;
    line-height: 1.6;
    margin-bottom: 30px;
}

.book-now {
    display: inline-block;
    background: #d81b60;
    color: white;
    padding: 15px 40px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    font-size: 18px;
    transition: 0.3s;
}

.book-now:hover {
    background: #ad144d;
    transform: scale(1.05);
}
</style>
</head>
<body>

<div class="details-wrapper">
    <div class="details-box">
        <a href="index.php" class="close-btn">&times;</a>

        <?php
        // ১. সার্ভিস লিস্ট অ্যারে (সংশোধিত ১৮টি সার্ভিস)
        $services = [
            1 => ["AC Repair & Service", 500, "Complete AC master service and gas refill.", "ac_service.jpg"],
            2 => ["Plumbing Service", 700, "Professional plumbing solutions for home.", "plumbing.jpg"],
            3 => ["Electrician Service", 600, "Electrical wiring and repair expert.", "electrician.jpg"],
            4 => ["Home Cleaning", 400, "Deep cleaning for rooms and furniture.", "cleaning.jpg"],
            5 => ["Painting Service", 1000, "Wall painting and home renovation service.", "painting.jpg"],
            6 => ["Pest Control", 800, "Effective solutions for insects and pests.", "pest_control.jpg"],
            7 => ["Home Shifting", 1500, "Safe and reliable home shifting service.", "shifting.jpg"],
            8 => ["CCTV Installation", 1200, "CCTV camera installation and setup.", "cctv.jpg"],
            9 => ["Car Wash", 300, "Complete car wash and interior polishing.", "car_wash.jpg"],
            10 => ["Bike Service", 250, "Full bike servicing and maintenance.", "bike_service.jpg"],
            11 => ["Carpenter", 900, "Furniture repair and carpentry work.", "carpenter.jpg"],
            12 => ["Glass Cleaning", 350, "Professional glass and window cleaning.", "glass_cleaning.jpg"],
            13 => ["Geyser Repair", 500, "Repair and installation of geysers.", "geyser_repair.jpg"],
            14 => ["Water Filter Service", 600, "Water filter installation and repair.", "water_filter.jpg"],
            15 => ["Sofa Cleaning", 450, "Deep sofa cleaning service.", "sofa_cleaning.jpg"],
            16 => ["Kitchen Cleaning", 400, "Complete kitchen cleaning service.", "kitchen_cleaning.jpg"],
            17 => ["Bathroom Cleaning", 400, "Bathroom and toilet deep cleaning service.", "bathroom_cleaning.jpg"],
            18 => ["IT Support & Networking", 1200, "Home IT support and networking setup.", "it_support.jpg"]
        ];

        // ২. আইডি চেক করে কন্টেন্ট দেখানো
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            if(isset($services[$id])){
                $service = $services[$id];
                
                // ইমেজ প্রদর্শন
                echo "<img src='images/$service[3]' alt='$service[0]' class='service-banner' onerror=\"this.src='https://via.placeholder.com/600x300?text=Service+Image'\">";
                
                echo "<div class='content-area'>";
                    echo "<h2 class='service-title'>$service[0]</h2>";
                    echo "<div class='price-pill'>Price: ৳$service[1]</div>";
                    echo "<p class='description'>$service[2]</p>";
                    echo "<a href='booking.php?service_id=$id' class='book-now'>Book Now</a>";
                echo "</div>";
            } else {
                echo "<div style='padding:50px; text-align:center;'><h2>Service Not Found!</h2><a href='index.php'>Back to Home</a></div>";
            }
        } else {
            echo "<div style='padding:50px; text-align:center;'><h2>Invalid Request!</h2><a href='index.php'>Back to Home</a></div>";
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>