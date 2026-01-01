<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<input type="checkbox" id="menuToggle" class="hidden">
<label for="menuToggle" class="hamburger">☰</label>
<nav class="mobile-menu">
    <a href="#home" class="head home">Home</a>
    <a href="#features" class="head feature">Features</a>
    <a href="#how-it-works" class="head how">How it Works</a>
    <a href="#contact" class="head contact">Contact</a>
    <a href="./login.php" class="head login mobile-login">Login</a>
    <form action="./User/complaint.php" method="get">
            <input type="submit" value="Submit Complaint" class="head submit mobile-submit">
        </form>
    <!-- <a href="./User/complaint.php" class="head submit mobile-submit">Submit Complaint</a> -->
</nav>
<div class="mobile-menu-overlay"></div>

<style>
#menuToggle:checked ~ .mobile-menu {
    left: 0;
}

.mobile-menu a,form {
    display: block;
    padding: 15px 25px;
    color: #36454F;
    font-size: 18px;
    text-decoration: none;
    border-bottom: 1px solid #eee;
}

.mobile-menu .mobile-login {
    color: #2563ea;
    font-weight: 500;
    border-radius: 8%;
    width: 50%;
}

.mobile-menu .mobile-submit {
    background: #2563ea;
    color: white !important;
    margin: 20px 15px;
    border-radius: 8px;
    text-align: center;
    width: 50%;
}

.mobile-menu-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 999;
}

@media (max-width: 768px) {
    .hamburger {
        display: block;
    }
    
    .header a.head {
        display: none;
    }
    
    .header .login,
    .header .submit {
        display: none;
    }
    
    #menuToggle:checked ~ .mobile-menu-overlay {
        display: block;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const menuLinks = document.querySelectorAll('a.head'); // Select all navigation links
    const overlay = document.querySelector('.mobile-menu-overlay');

    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if(href.startsWith('#')) {
                e.preventDefault();
                const target = document.querySelector(href);
                if(target) {
                    // Close mobile menu if open
                    if(menuToggle.checked) {
                        menuToggle.checked = false;
                        overlay.style.display = 'none';
                    }
                    
                    // Smooth scroll to section
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
            // Handle external links
            else if(!href.startsWith('#')) {
                e.preventDefault();
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            }
        });
    });

    // Existing overlay click handler...
});
</script>


    <div class="header" >
        <img src="./Img/logo.jpg" alt="Campus Voice Logo" class="logo"><h3>CampusVoice</h3>
        <a href="#home" class="head home">Home</a>
        <a href="#how-it-works" class="head feature">Features</a>
        <a href="#how-it-works" class="head how">How it Works</a>
        <a href="#contact" class="head contact">Contact</a>
        <a href="./login.php" class="head login">Login</a>
        <form action="./User/complaint.php" method="get">
            <input type="submit" value="Submit Complaint" class="head submit">
        </form>
    </div>

    
    <div class="first" id="home">
        <br><br>
        <h1 class="Your"><b>Your Voice Matters to Us</b></h1>
        <h3 class='sentence'>Submit and track your complaint easily.We're here to make your Campus experience better.</h3>
            <div class="btn first1btn"><a href="./User/complaint.php" style='font-size:18px;color:#FFFF'>Submit New Complaint</a></div>
            <div class="btn first2btn"><a href="./User/view.php" style='font-size:18px;'>Track Complaints</a></div>
    </div>

    <div style='width: 100%;height: fit-content;text-align: center;'>
        <img src="./Img/welcome1.png" alt="" height="500px">
    </div>

    <div class="second" id="how-it-works">
        <h1 style='margin-top:30px;font-size:30px;text-align: center;'>How it Works</h1><br>

        <div class="second1" style="margin-left: 350px;">
            <img src="./Img/msg.png" alt="" class="secondimg">
            <h2>Submit Complaint</h2>
            <p class="sentence2">File your complaint with relevant details and category</p>
        </div>
        <div class="second1" style="margin-top: -10px;">
            <img src="./Img/clock.png" alt="" class="secondimg">
            <h2>Track Progress</h2>
            <p class="sentence2">Monitor the status of your complaint in real time</p>

        </div>
        <div class="second1" style="margin-top: -20px;">
            <img src="./Img/check.png" alt="" class="secondimg">
            <h2>Get Resolution</h2>
            <p class="sentence2">Receives updates and resolution for your complaint</p>
        </div>
    </div>

    <div style='width: 100%;height: fit-content;text-align: center;'>
        <img src="./Img/welcome2.png" alt="" >
    </div>

    <div class="third">
        <div style="height: 300px;width: 20%;margin-left: 80px;" id="contact">
            <div style="display: flex;align-items: center;">
                <img src="./Img/logo.jpg" alt="" style='height: 40px;width: 40px;border-radius: 10px;margin-right: 10px;'>
                <h3>CampusVoice</h3>
            </div>    
            <p class="sentence2" style='margin-top: 20px;width: 100%;'>Making your Campus experience better through effective complaint management</p>
        </div>

        <div style='height: 300px;width: 20%;margin-left: 90px;'>
            <h3>Quick Links</h3><br>

            <a href="./User/dashboard.php" class='footerA'>Home</a><br><br>
            <a href="./User/complaint.php" class='footerA'>Submit Complaint</a><br><br>
            <a href="./User/complaint.php" class='footerA'>Submit Suggestion</a><br><br>
            <a href="./User/view.php" class='footerA'>Track Complaint</a>
        </div>

        <div style='height: 300px;width: 20%;margin-left: 90px;'>
            <h3>Help and Support</h3><br>
            <h4>FAQs</h4>
            <h4>Contact US</h4>
            <h4>Privacy policy</h4>

        </div>

        <div style='height: 300px;width: 20%;margin-left: 90px;'>
            <h3>Contact</h3>

            <h4>support@campusvoice.edu</h4>
            <h4>+21 123-45678</h4>
        </div>
    </div>

   
</body>
</html>