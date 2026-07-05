<?php
// session_start(); // প্রয়োজনে আনকমেন্ট করুন
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sheba Style Header</title>

  <style>
    body {margin:0; font-family:Arial, sans-serif; background-color: #fff;}
    /* হেডারকে আলাদা রাখার জন্য বক্স-সাইজিং ব্যবহার করা হয়েছে */
    .header {
        width:100%;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:10px 30px;
        border-bottom:1px solid #eee;
        position:sticky; /* স্ক্রল করার সময় হেডার উপরে থাকবে */
        top: 0;
        background: white;
        z-index: 1000;
        box-sizing: border-box;
    }
    .left {display:flex; align-items:center; gap:15px;}
    .logo {font-size:22px; font-weight:bold; color:#d6006f; cursor:pointer;}
    .location-box {display:flex; align-items:center; gap:5px; cursor:pointer; font-size:16px;}
    
    .search-box {display:flex; align-items:center; width:450px; border:1px solid #ccc; border-radius:8px; overflow:hidden;}
    .search-box input {width:100%; padding:10px; border:none; outline:none; font-size:15px;}
    .search-btn {background:#d6006f; color:white; padding:10px 14px; cursor:pointer;}
    
    .right {display:flex; align-items:center; gap:25px; font-size:16px;}
    .sheba-pay {border:2px solid #d6006f; color:#d6006f; padding:6px 14px; border-radius:8px; cursor:pointer; font-weight:600; text-decoration: none;}
    .sheba-pay:hover {background: #d6006f; color: white;}
    .cart {font-size:20px; cursor:pointer;}

    /* লিস্টগুলোর অবস্থান ঠিক করা হয়েছে */
    #service-list, #location-list {
      position:absolute;
      top:65px;
      left: 50%;
      transform: translateX(-50%);
      background:white;
      width:450px;
      max-height:300px;
      overflow-y:auto;
      border:1px solid #ddd;
      border-radius:8px;
      display:none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      z-index:1001;
    }
    .item {padding:10px 15px; border-bottom:1px solid #eee; cursor:pointer; font-size: 14px;}
    .item:hover {background:#f9f9f9; color: #d6006f;}
  </style>
</head>
<body>

<div class="header">
  <div class="left">
    <div class="logo" onclick="window.location='index.php'">sheba.xyz</div>
    <div class="location-box" onclick="toggleLocation()">📍 
      <span id="selected-location">Select Location</span>
    </div>
  </div>

  <div class="search-box">
    <input type="text" placeholder="Find your service here e.g. AC, Car, Facial ..." onkeyup="filterServices(this.value)">
    <div class="search-btn" onclick="showServices()">🔍</div>
  </div>

  <div class="right">
    <a href="sheba_pay.php" class="sheba-pay">Sheba Pay</a>
    <a href="login.php" style="text-decoration:none; color:black;">Login</a>
    <div class="cart">🛒</div>
  </div>
</div>

<div id="service-list"></div>
<div id="location-list"></div>

<script>
  const services = ["AC Repair", "Car Wash", "Facial", "Electrician", "Plumbing", "Home Cleaning", "Pest Control", "Painting", "Salon For Men", "Salon For Women", "Geyser Repair", "Refrigerator Repair", "Water Purifier Service", "Computer Repair", "Laptop Service", "CCTV Installation", "Shifting Service", "House Maid"];
  const bangladeshLocations = { "Dhaka Division": ["Dhaka", "Gazipur", "Narayanganj"], "Chattogram Division": ["Chattogram", "Cox's Bazar"], "Rajshahi Division": ["Rajshahi", "Bogra"] };

  function showServices() {
    const box = document.getElementById("service-list");
    box.innerHTML = services.map(s => `<div class='item' onclick='goService("${s}")'>${s}</div>`).join("");
    box.style.display = box.style.display === "block" ? "none" : "block";
  }

  function goService(name) { window.location = "services.php?search=" + encodeURIComponent(name); }

  function filterServices(text) {
    const box = document.getElementById("service-list");
    if(!text) { box.style.display = "none"; return; }
    const filtered = services.filter(s => s.toLowerCase().includes(text.toLowerCase()));
    box.innerHTML = filtered.map(s => `<div class='item' onclick='goService("${s}")'>${s}</div>`).join("");
    box.style.display = "block";
  }

  function toggleLocation() {
    const box = document.getElementById("location-list");
    if (box.style.display === "block") { box.style.display = "none"; return; }
    box.style.display = "block";
    let html = "";
    for (let div in bangladeshLocations) {
      html += `<div class='item' style='background:#f1f1f1; font-weight:bold;'>${div}</div>`;
      bangladeshLocations[div].forEach(loc => {
        html += `<div class='item' onclick='selectLocation("${loc}")'>• ${loc}</div>`;
      });
    }
    box.innerHTML = html;
  }

  function selectLocation(loc) {
    document.getElementById("selected-location").innerText = loc;
    document.getElementById("location-list").style.display = "none";
  }
</script>