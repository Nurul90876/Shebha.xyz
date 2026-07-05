<?php
include("header.php"); 
?>

<div style="min-height: 80vh; background: #f4f7f6; padding: 60px 20px; font-family: 'Segoe UI', Arial, sans-serif;">
    <div style="max-width: 900px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); border-top: 8px solid #d81b60;">
        
        <div style="text-align: center; margin-bottom: 40px;">
            <div style="margin-bottom: 20px;">
                <img src="images/your_photo.jpg" alt="Developer Nurul Alam" style="width: 150px; height: 150px; border-radius: 50%; border: 4px solid #d81b60; padding: 5px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/150?text=Nurul+Alam'">
            </div>
            <h1 style="color: #2c3e50; margin: 0; font-size: 32px;">Nurul Alam</h1>
            <p style="color: #d81b60; font-size: 18px; font-weight: 600; margin-top: 5px;">Full-Stack Web Developer</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; border-top: 1px solid #eee; padding-top: 30px;">
            
            <div>
                <h3 style="color: #2c3e50; border-left: 4px solid #d81b60; padding-left: 10px; margin-bottom: 15px;">ABOUT ME</h3>
                <p style="line-height: 1.8; color: #555; text-align: justify;">
                    I am a passionate web developer. I built this <strong>Household Service Management System</strong> project to help people easily book essential home services online. Coding and learning new technologies is my passion.
                </p>
            </div>

            <div>
                <h3 style="color: #2c3e50; border-left: 4px solid #d81b60; padding-left: 10px; margin-bottom: 15px;">SKILLS & CONTACT</h3>
                
                <div style="margin-bottom: 20px;">
                    <span style="background: #fde8ef; color: #d81b60; padding: 5px 12px; border-radius: 15px; font-size: 13px; margin-right: 5px; display: inline-block; margin-bottom: 5px; font-weight: bold;">PHP & MySQL</span>
                    <span style="background: #fde8ef; color: #d81b60; padding: 5px 12px; border-radius: 15px; font-size: 13px; margin-right: 5px; display: inline-block; font-weight: bold;">HTML5 & CSS3</span>
                    <span style="background: #fde8ef; color: #d81b60; padding: 5px 12px; border-radius: 15px; font-size: 13px; margin-right: 5px; display: inline-block; font-weight: bold;">JavaScript</span>
                </div>

                <p style="margin: 5px 0; color: #555;"><strong>Email:</strong> Nurcse90@gmail.com</p>
                <p style="margin: 5px 0; color: #555;"><strong>Location:</strong> Chattogram, Bangladesh</p>
                
                <div style="margin-top: 20px;">
                    <a href="https://facebook.com" style="color: #d81b60; font-size: 20px; margin-right: 15px; text-decoration: none;"><i class="fab fa-facebook"></i></a>
                    <a href="https://linkedin.com" style="color: #d81b60; font-size: 20px; margin-right: 15px; text-decoration: none;"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com" style="color: #d81b60; font-size: 20px; text-decoration: none;"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="index.php" style="background: #d81b60; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; transition: 0.3s; display: inline-block;">
                Back to Home
            </a>
        </div>

    </div>
</div>

<?php include("footer.php"); ?>