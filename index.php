<?php
// index.php
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sheba Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    body {
        margin:0;
        font-family: 'Segoe UI', Arial, sans-serif;
        display:flex;
        flex-direction:column;
        min-height:100vh; 
        background:#f7f7f7;
    }
    .container { display:flex; flex:1; } 
    .sidebar{
        width:260px;
        background:white;
        padding:25px 20px;
        box-shadow:0 0 8px rgba(0,0,0,0.08);
        height:fit-content;
    }
    .sidebar h2{margin-bottom:15px; font-size: 20px; color: #333;}
    .side-item{padding:12px 5px; font-size:14px; color:#444; border-left:3px solid transparent; cursor:pointer; transition:0.2s; list-style: none;}
    .side-item:hover{background:#fde8ef; border-left-color:#d81b60; font-weight:bold; color:#d81b60;}
    
    .main{
        flex:1;
        padding:20px 40px;
    }
    .hero{
        background:#d81b60;
        color:white;
        padding:60px 30px;
        text-align:center;
        border-radius:10px;
        margin-bottom:20px;
    }
    .hero h1{font-size:36px; margin-bottom:10px;}
    .hero p{font-size:16px; margin-bottom:15px;}
    .hero button{padding:10px 25px; background:white; color:#d81b60; border:none; font-size:16px; border-radius:5px; cursor:pointer; transition: 0.3s;}
    .hero button:hover{background: #f1f1f1;}
    
    .section-title{font-size:22px; margin:20px 0 15px; font-weight:bold; color: #333;}
    
    /* Category Grid Style */
    .category-grid {
        display: grid; 
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); 
        gap: 15px; 
        margin-bottom: 30px;
    }
    .cat-box{
        background:white; 
        padding:10px; 
        border-radius:12px; 
        box-shadow:0 2px 8px rgba(0,0,0,0.06); 
        text-align:center; 
        cursor:pointer; 
        transition:.3s;
        text-decoration:none;
        color:inherit;
    }
    .cat-box:hover{
        background:#fff; 
        transform:translateY(-5px);
        box-shadow: 0 5px 15px rgba(216, 27, 96, 0.2);
    }
    
    /* Icon Overlay on Image */
    .img-container {
        position: relative;
        width: 100%;
        height: 90px;
        overflow: hidden;
        border-radius: 10px;
    }
    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .img-container i {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: rgba(216, 27, 96, 0.9);
        color: white;
        padding: 6px;
        border-radius: 50%;
        font-size: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    /* Top Technicians Grid Style */
    .provider-grid{display:flex; gap:15px; flex-wrap:wrap; margin-bottom:30px;}
    .provider-card{
        background:white; 
        flex:1; 
        min-width:180px; 
        padding:20px; 
        border-radius:15px; 
        box-shadow:0 2px 8px rgba(0,0,0,0.08); 
        text-align:center;
        transition: 0.3s;
    }
    .provider-card:hover {
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .tech-pic {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
        border: 3px solid #fde8ef;
    }
    .provider-card h4 { margin: 10px 0 5px; color: #333; }
    .provider-card span { color:#d81b60; font-weight:bold; }
    .provider-card .job-count { color: #666; font-size: 13px; display: block; margin-top: 5px; }
</style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <div class="sidebar">
        <h2>All Services</h2>
        <ul>
            <li class="side-item">AC Repair Service</li>
            <li class="side-item">Appliance Repair</li>
            <li class="side-item">Cleaning Solution</li>
            <li class="side-item">Beauty & Wellness</li>
            <li class="side-item">Shifting</li>
            <li class="side-item">Health & Care</li>
            <li class="side-item">Men’s Care & Salon</li>
            <li class="side-item">Electronics & Gadget Service</li>
            <li class="side-item">Electric & Plumbing</li>
            <li class="side-item">Pest Control</li>
            <li class="side-item">Driver Service</li>
            <li class="side-item">Car Care Service</li>
            <li class="side-item">Trips & Travel</li>
            <li class="side-item">Car Rental</li>
            <li class="side-item">Painting & Renovation</li>
            <li class="side-item">Best Deal</li>
            <li class="side-item">Emergency Service</li>
            <li class="side-item">AI Service</li>
        </ul>
    </div>

    <div class="main">
        <div class="hero">
            <h1>Welcome to Sheba</h1>
            <p>Your Daily Household Services in One Place</p>
            <button onclick="window.location.href='register.php'">Please registration</button>
        </div>

        <div class="section-title">Popular Services</div>
        
        <div class="category-grid">
            <a href="service_details.php?id=1" class="cat-box">
                <div class="img-container">
                    <img src="images/ac_service.jpg" onerror="this.src='https://via.placeholder.com/150?text=AC'">
                    <i class="fa-solid fa-snowflake"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">AC Repair</div>
            </a>

            <a href="service_details.php?id=4" class="cat-box">
                <div class="img-container">
                    <img src="images/cleaning.jpg" onerror="this.src='https://via.placeholder.com/150?text=Cleaning'">
                    <i class="fa-solid fa-broom"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">Cleaning</div>
            </a>

            <a href="service_details.php?id=5" class="cat-box">
                <div class="img-container">
                    <img src="images/painting.jpg" onerror="this.src='https://via.placeholder.com/150?text=Painting'">
                    <i class="fa-solid fa-paint-roller"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">Painting</div>
            </a>

            <a href="service_details.php?id=2" class="cat-box">
                <div class="img-container">
                    <img src="images/plumbing.jpg" onerror="this.src='https://via.placeholder.com/150?text=Plumbing'">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">Plumbing</div>
            </a>

            <a href="service_details.php?id=6" class="cat-box">
                <div class="img-container">
                    <img src="images/pest_control.jpg" onerror="this.src='https://via.placeholder.com/150?text=Pest'">
                    <i class="fa-solid fa-bug"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">Pest Control</div>
            </a>

            <a href="service_details.php?id=9" class="cat-box">
                <div class="img-container">
                    <img src="images/car_wash.jpg" onerror="this.src='https://via.placeholder.com/150?text=Car'">
                    <i class="fa-solid fa-car"></i>
                </div>
                <div style="font-weight:bold; font-size:14px; margin-top:10px;">Car Care</div>
            </a>
        </div>

        <div class="section-title">Top Technicians</div>
        <div class="provider-grid">
            <div class="provider-card">
                <img src="images/tech_rahim.jpg" class="tech-pic" alt="Rahim" onerror="this.src='https://www.w3schools.com/howto/img_avatar.png'">
                <h4>AC Expert Rahim</h4>
                <span>⭐ 4.9</span>
                <div class="job-count">120+ Jobs Completed</div>
            </div>
            <div class="provider-card">
                <img src="images/tech_karim.jpg" class="tech-pic" alt="Karim" onerror="this.src='https://www.w3schools.com/howto/img_avatar.png'">
                <h4>Electrician Karim</h4>
                <span>⭐ 4.8</span>
                <div class="job-count">200+ Jobs Completed</div>
            </div>
            <div class="provider-card">
                <img src="images/tech_nishi.jpg" class="tech-pic" alt="Nishi" onerror="this.src='https://www.w3schools.com/howto/img_avatar2.png'">
                <h4>Cleaning Specialist Nishi</h4>
                <span>⭐ 5.0</span>
                <div class="job-count">150+ Jobs Completed</div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>