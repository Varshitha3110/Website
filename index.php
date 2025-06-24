<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin_signup.html");
    exit();
}
?>

<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechGesture</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">



    <style>
         .logo {
            width: 100px;
            height: auto;
        
        }
      





nav.main-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 10px; /* reduce vertical padding */
    position: relative;
    margin-bottom: 0; /* ensure no gap below */
}

.nav-center-greeting {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 0;
}

section.header nav:nth-of-type(2) {
    margin-top: 0;
    padding-top: 0;
}

.greeting {
    font-size: 30px;
    font-weight: bold;
    color: #f1f1f1;
    font-family: 'Times New Roman', Times, serif;
    margin: 0;
    padding: 0;
    border-radius: 0;
    box-shadow: none;
    background: none;
}

.logout-container {
    display: flex;
    align-items: center;
}

.logout-btn {
    color: white;
    padding: 10px 18px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
}

.logout-btn:hover {
    background-color:blue;
    transform: scale(1.05);
}

.logout-btn i {
    margin-right: 6px;
}


    </style>

</head>

<body>

    <!-- Your existing nav links -->
    



    <section class="header">
<nav class="main-nav">
    <a href="index.html">
       
    </a>

    <div class="nav-center-greeting">
        <span class="greeting">👋 Hello, <?php echo htmlspecialchars($_SESSION['user']); ?>!</span>
    </div>

    <div class="logout-container">
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out"></i> Logout
        </a>
    </div>
</nav>
        <nav>
            <a href="index.html">
                <div class="logo">
                    <img src="images/logo.png" alt="TechGesture Logo" style="width: 100%;">
                </div>
            </a>

            <div class="nav-links" id="navLinks">
                <i class="fa fa-close" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li class="dropdown">
                        <a href="projects.html">PROJECTS</a>
                        <ul class="dropdown-menu">
                            <li><a href="gesture.html">Gesture Detection</a></li>
                            <li><a href="ai-virt-key.html">Virtual Keyboard</a></li>
                            <li><a href="ai-hand-mouse.html">AI Hand Mouse</a></li>
                        </ul>
                    </li>
                    <li><a href="blog.html">BLOG</a></li>
                    <li><a href="contact.html">CONTACT</a></li>
                </ul>
            </div>

            <i class="fa fa-bars" onclick="showMenu()"></i>

        </nav>

        <div class="text-box">
            <h1 style="font-family: 'Lucida Handwriting', cursive; font-size: 48px; color: #F5FFFA	;">AI TechyGestures
            </h1>
            <p>Exploring the Future with Artificial Intelligence
            </p>
            <a href="https://www.youtube.com/@TechyGestures" class="hero-btn" target="_blank">Visit Us to Know More</a>
        </div>
    </section>

    <!---------- course ----------->

    <section class="course">
        <h1>AI and Ml Projects</h1>
        <p>"Every line of code tells a story."</p>
        <p>Explore the diverse range of projects we've crafted- each one a step forward in creative, technoloy, and real-worls problem solving.</p>
        <div class="row">
            <div class="course-col">
                <a href="gesture.html" style="text-decoration: none; color: inherit;">
                    <h3>Gesture Detection</h3>
                    <p><i>"Experience the freedom of touchless interaction."</i> <br><br> Transform your device into a responsive, intelligent system that understands your movements—no buttons, no contact, just gestures.</p>
                </a>
            </div>

            <div class="course-col">
                <a href="ai-virt-key.html" style="text-decoration: none; color: inherit;">
                    <h3>AI Virtual Keyboard</h3>
                    <p><i>"Type smarter. Touch less." </i><br><br> A revolutionary keyboard powered by artificial intelligence that adapts to your gestures, speech, and intent—no physical keys required.</p>
                </a>
            </div>

            <div class="course-col">
                <a href="ai-hand-mouse.html" style="text-decoration: none; color: inherit;">
                    <h3>Hand Mouse</h3>
                    <p><i>"Control your computer with just your hand!" </i><br><br> Experience effortless navigation and interaction without the need for a traditional mouse or touchpad.
                    </p>
                </a>
            </div>
        </div>

    </section>

    <!---------- campus ---------->

    <section class="campus">
        <h1>Our Global Achievements</h1>
        <p>"Empowering Innovation. Driving Change. Inspiring the Future."</p>
        <p>At TechyGestures, we pride ourselves on our global impact and the groundbreaking work we've done across industries. </p>
        <div class="row">
            <div class="campus-col">
                <a href="our_achievments.html">
                    <img src="images/2.jpg">
                    <div class="layer">
                        <h3>Udemy</h3>
                    </div>
                </a>
            </div>
            <div class="campus-col">
                <a href="our_achievments.html">

                    <img src="images/4.jpg">
                    <div class="layer">
                        <h3>Prinston Smart Engineers</h3>
                    </div>
                </a>
            </div>
            <div class="campus-col">
                <a href="our_achievments.html">

                    <img src="images/3.jpg">
                    <div class="layer">
                        <h3>Anudip Foundation</h3>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <!---------- Facilities ---------->

    <section class="facility">
        <h1>Our Facilities</h1>
        <p>"Where Innovation Meets Excellence."

            <p>At TechyGestures, we believe that the right environment fosters creativity, collaboration, and groundbreaking achievements. Our facilities are designed to support and inspire our talented team, enhance our research and development processes,
                and deliver the best solutions to our clients.</p>
        </p>
        <div class="row">
            <div class="facility-col">
                <a href="handwritten_notes.html">
                    <img src="images/1.jpg">
                </a>
                <h3>Handwritten Notes</h3>

                <p><b><i>"Personalized Notes, Just for You"</i></b> <br></p>
                <p> Get access to exclusive handwritten notes, tailored to your learning or project needs. </p>

                </p>
            </div>
            <div class="facility-col">
                <a href="free_code.html">
                    <img src="images/freecode.jpeg">
                </a>
                <h3>Free codes</h3>
                <p><b><i>"Unlock Free Resources"</i></b></p>
                <p> Access a collection of free, ready-to-use code snippets, templates, and utilities.</p>
            </div>
            <div class="facility-col">
                <a href="recomendation.html">
                    <img src="images/recommend.jpeg">
                </a>
                <h3>Recommendations</h3>
                <p><b><i>"Handpicked Just for You"</i></b></p>
                <p>Explore curated recommendations based on your interests and preferences.</p>
            </div>
        </div>
    </section>


    <!---------- testimonials ---------->

    <section class="testimonials">
        <h1>Our Profile</h1>
        <p>Know us more. Meet the brilliant minds behind TechGesture.</p>

        <div class="card-container">
            <!-- Card 1 -->
            <a href="varshi.html">
                <div class="card">

                    <div class="card__border">
                        <div class="card__perfil">
                            <img src="images/varshi.jpg" alt="Varshitha" class="card__img">
                        </div>

                    </div>
            </a>
            <h3 class="card__name">Koguru Varshitha</h3>
            <span class="card__profession">AI Specialist</span>

            <div class="info">
                <div class="info__icon">
                    <i class="ri-information-line"></i>

                </div>
                <div class="info__border">
                    <a href="varshi.html">
                        <div class="info__perfil">
                            <img src="images/varshi.jpg" alt="profile" class="info__img">
                        </div>
                    </a>
                </div>
                <div class="info__data">
                    <h3 class="info__name">Koguru Varshitha</h3>
                    <span class="info__profession">Bachelor's in Computer Application</span>
                    <span class="info__location">Bengaluru</span>
                </div>
                <div class="info__social">
                    <a href="https://linkedin.com/in/koguru-varshitha-019140343" target="_blank" class="info__social-link">
                        <i class="ri-linkedin-box-line info__social-icon"></i>
                    </a>
                    <a href="https://youtube.com/@koguruvarshitha859" target="_blank" class="info__social-link">
                        <i class="ri-youtube-fill info__social-icon"></i>
                    </a>
                    <a href="https://github.com/Varshitha3110" target="_blank" class="info__social-link">
                        <i class="ri-github-fill info__social-icon"></i>
                    </a>
                </div>
            </div>

            </div>

            <!-- Card 2 -->
            <div class="card">
                <a href="keerthan.html">

                    <div class="card__border">
                        <div class="card__perfil">
                            <img src="images/about.jpg" alt="Keerthan" class="card__img">
                        </div>
                    </div>
                </a>

                <h3 class="card__name">Keerthan Kumar L V</h3>
                <span class="card__profession">Full-Stack Developer</span>

                <div class="info">

                    <div class="info__icon">
                        <i class="ri-information-line"></i>

                    </div>
                    <div class="info__border">
                        <a href="keerthan.html">
                            <div class="info__perfil">
                                <img src="images/about.jpg" alt="profile" class="info__img">
                            </div>
                        </a>
                    </div>
                    <div class="info__data">
                        <h3 class="info__name">Keerthan Kumar L V</h3>
                        <span class="info__profession">Bachelor's in Computer Application</span>
                        <span class="info__location">Bengaluru</span>
                    </div>
                    <div class="info__social">
                        <a href="https://linkedin.com/in/keerthankumar-lv" target="_blank" class="info__social-link">
                            <i class="ri-linkedin-box-line info__social-icon"></i>
                        </a>
                        <a href="https://youtube.com/@koguruvarshitha859" target="_blank" class="info__social-link">
                            <i class="ri-youtube-fill info__social-icon"></i>
                        </a>
                        <a href="https://github.com/Keerthan-07" target="_blank" class="info__social-link">
                            <i class="ri-github-fill info__social-icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <div></div>
    <div></div>
    <br>
    <br><br><br>
    <div></div>
    <div>

        <!-------- footer ---------->
        <hr style="border: 1px solid #ccc; width: 80%; margin: 20px auto;">

        <section class="footer">
            <h4 style="padding-top: 5px;">About Us</h4>
            <p style="align-items: center;nav-left: auto;padding-left: 200px;padding-right: 200px;">We are driven by a passion for technology and a commitment to improving lives through innovation. Founded on the belief that technology should be intuitive, accessible, and impactful, we work tirelessly to bring ideas to life that redefine
                how people interact with the digital world.</p>
            <div class="icons">
                <a href="https://www.facebook.com"><i
                        class="fa fa-facebook"></i></a>
                <a href="https://www.twitter.com"><i
                        class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com"><i
                        class="fa fa-instagram"></i></a>
                <a href="https://www.linkedin.com"><i
                        class="fa fa-linkedin"></i></a>

            </div>
            <a href="https://www.youtube.com/@TechyGestures" class="footer-link">
                <p>made with <i class="fa fa-heart-o"></i> by TechyGestures</p>
            </a>
        </section>


        <!----JavaScript for toggle menu---->
        <script>
            var navLinks = document.getElementById("navLinks");

            function showMenu() {
                navLinks.style.right = "0";
            }

            function hideMenu() {
                navLinks.style.right = "-200px";
            }
        </script>

</body>

</html>