<?php
session_start();
    include("connections.php");
    include("functions.php");
    include 'header.php'; // Include the session management logic

$user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <script defer src="./js/index.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <title>Zildai Beauty Parlour</title>
</head>
<body>
    <!-- Navbar Section -->
    <nav class="navbar">
        <div class="navbar__container">
            <a href="#home" id="navbar__logo">ZILDAI</a>
            <!-- This is our hamburger menu -->
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span> 
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="navbar__menu">
                <li class="navbar__item">
                  <a href="#home" class="navbar__links" id="home-page">Home</a>
                </li>
                <li class="navbar__item">
                  <a href="#about" class="navbar__links" id="about-page">About Us</a>
                </li>
                <li class="navbar__item">
                  <a href="booking.php" class="navbar__links" id="services-page"
                    >Services</a
                  >
               
                  <li class="navbar__item" style="color: red;">
                Hello, <?php echo htmlspecialchars($user_data['user_name']); ?>
                <br>
                <span style="font-size: 14px;"><?php echo htmlspecialchars($user_data['email']); ?></span>
            </li>
                </li>

               
                <!-- <li class="navbar__btn">
                  <a href="#sign-up" class="button" id="signup">Sign Up</a>
                </li> -->
              </ul>
              <!-- <div class="search-box">
                <input type="text" class="tbox" placeholder="Search.." onkeyup="search_service()" id="searchbar" >
                <button class="search-btn"><i class="fas fa-search"></i></button>
              </div>
        </div> -->
        <li><button onclick="document.location='logout.php'">Log Out </button></li>

    </nav>

    

<script>
    function changeText(id) 
    {
    id.innerHTML = "Feel comfortable using our website";
    }
</script>

    <!-- The Hero Section -->
    <div class="hero" id="home">
        <div class="hero__container">
          <h1 class="hero__heading">Welcome to <br><span>Zildai Beauty Parlour</span></h1>
          <p class="hero__description">Unlimited Possibilities. <br><span> You've got your own style and your own attitude, so you should have a professional space that is totally you.</span></p>
          <button class="main__btn"><a href="booking.php">Explore our services and book</a></button>
        </div>
    </div>

    <!-- The About Section -->
    <div class="main" id="about">
        <div class="main__container">
          <div class="main__img--container">
            <!-- An image <i class="fas fa-layer-group"></i>-->
            <div class="main__img--card">
                <img src="media/icons8-team-ZGzHKEpem88-unsplash.jpg" alt="Pic">
                <h2 id="sensational">Sensational Experience</h2>
            </div>
          </div>
          <!-- The Content -->
          <div class="main__content">
            <h1>What do we do?</h1>
            <h2>We are here to help you achieve your desired look. We want our clients waking up every morning feeling flawless.</h2>
            <p>Zildai Beauty parlour is a top-notch nail salon,hair salon, facials and spa in Nairobi, Kenyatta Avenue.<br> Our nail and spa salon is the most affordable and professional. We focus on customer safety, needs, and satisfaction.</p>
            <p>We want you to experience our chic, welcoming, and comfortable med spa offering a variety of services. So much more than eyelash services, we provide beautiful experiences delivered under the care of our physicians, nurses, and estheticians.</p>
            <!-- <button class="main__btn"><a href="#">Schedule Call</a></button> -->
            <button class="main__btn"><a href="#services">Schedule Call</a></button>
          </div>
        </div>
      </div>
      
    <!-- Services Section -->
    
    <!-- Footer Section -->
    <div class="footer__container">
      <div class="footer__links">
        <div class="footer__link--wrapper">
          <div class="footer__link--items">
            <h2>About Us</h2>
            <a href="/sign__up">How it works</a> <a href="/">Testimonials</a>
            <a href="/">Careers</a> <a href="/">Terms of Service</a>
          </div>
          <div class="footer__link--items">
            <h2>Contact Us</h2>
            <a href="/">Contact: +25456427433</a> 
            <a href="/">Support: zildai@helpdesk.com</a>
            <a href="/">Address: 1174-101000 P.O BOX Laister</a>
          </div>
        </div>
        <div class="footer__link--wrapper">
          <div class="footer__link--items">
            <h2>Videos</h2>
            <a href="/">Submit Video</a> 
            <a href="/">Ambassadors</a>
            <a href="/">Agency</a>
          </div>
          <div class="footer__link--items">
            <h2>Social Media</h2>
            <a href="/">Instagram: @zildai.instagram</a> 
            <a href="/">Facebook: @zildai.facebook</a>
            <a href="/">Youtube: @zildai.youtube</a> 
            <a href="/">Twitter: @zildai.twitter</a>
          </div>
        </div>
      </div>
      <section class="social__media">
        <div class="social__media--wrap">
          <div class="footer__logo">
            <a href="/" id="footer__logo">ZILDAI</a>
          </div>
          <p class="website__rights">© ZILDAI 2023. All rights reserved</p>
          <div class="social__icons">
            <a href="/" class="social__icon--link" target="_blank"
              ><i class="fab fa-facebook"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-instagram"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-youtube"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-linkedin"></i
            ></a>
            <a href="/" class="social__icon--link"
              ><i class="fab fa-twitter"></i
            ></a>
          </div>
        </div>
      </section>
    </div>

</body>
</html>