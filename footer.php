<style>
    .footer {
        background: #f4f4f6;
        padding: 50px 60px;
        font-family: Arial, sans-serif;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 40px;
    }

    .footer h3 {
        font-size: 18px;
        margin-bottom: 10px;
        font-weight: bold;
        color: #000;
    }

    .footer p, 
    .footer a {
        color: #444;
        text-decoration: none;
        line-height: 1.6;
        font-size: 14px;
    }

    .footer a:hover {
        color: #d81b60;
    }

    /* App Icons */
    .app-buttons img {
        width: 150px;
        margin-right: 10px;
        cursor: pointer;
    }

    /* Social Icons */
    .social-icons {
        margin-top: 15px;
    }

    .social-icons i {
        font-size: 22px;
        margin-right: 15px;
        color: #777;
        cursor: pointer;
        transition: 0.3s;
    }

    .social-icons i:hover {
        color: #d81b60;
    }

    /* Bottom Copy */
    .footer-bottom {
        text-align: center;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #ccc;
        font-size: 14px;
        color: #444;
    }

    /* Admin Link Style */
    .admin-link {
        color: #bbb !important; /* হালকা রঙ যাতে সহজে চোখে না পড়ে */
        text-decoration: none;
        margin-left: 10px;
        font-size: 12px;
    }

    .admin-link:hover {
        color: #d81b60 !important;
        text-decoration: underline !important;
    }

    @media(max-width: 900px){
        .footer-container{
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 600px){
        .footer-container{
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<footer class="footer">

    <div class="footer-container">

        <div>
            <h3>CONTACT</h3>
            <p>01888615409</p>
            <p>info@sheba.XYZ</p>

            <p><strong>Corporate Address</strong><br>
               M&S Tower, Plot: 2, Road: 11,<br>
               Block: H, Shahamir Pur, Chattagram</p>

            <p><strong>TRADE LICENSE NO</strong><br>
               TRAD/DNCC/145647/2022</p>
        </div>

        <div>
            <h3>OTHER PAGES</h3>
            <a href="blog.php">Blog</a><br>
            <a href="help.php">Help</a><br>
            <a href="terms.php">Terms of use</a><br>
            <a href="privacy.php">Privacy Policy</a><br>
            <a href="refund.php">Refund & Return Policy</a><br>
            <a href="sitemap.php">Sitemap</a>
        </div>

        <div>
            <h3>COMPANY</h3>
            <a href="smanager.php">sManager</a><br>
            <a href="sbusiness.php">sBusiness</a><br>
            <a href="sdelivery.php">sDelivery</a><br>
            <a href="sbondhu.php">sBondhu</a>
        </div>

        <div>
            <h3>DOWNLOAD OUR APP</h3>
            <p>Tackle your to-do list with our mobile app & make your life easy.</p>

            <div class="app-buttons">
                <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg">
            </div>

            <div class="social-icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-linkedin"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        Copyright © 2025 Sheba Platform Limited | All Rights Reserved | 
        <a href="admin_login.php" class="admin-link">Admin Login</a>
        <a href="about_developer.php">About Developer</a><br>
    </div>

</footer>