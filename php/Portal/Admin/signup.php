<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start the session if it hasn't started
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Garden of Memories | Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/img/green_tree_icon.png" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link rel="stylesheet" href="../../../assets/css/main.css">
</head>

<body>

  <header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a href="">info@gardenofmemories.ph</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>(02) 642 6181</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://www.facebook.com/profile.php?id=100064140905935" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-twitter"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="../../../admin_landing_page.php" class="logo d-flex align-items-center">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <h1 class="sitename">Garden of Memories</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="../../../admin_landing_page.php#hero" class="">Home</a></li>
            <li><a href="../../../admin_landing_page.php#about">About</a></li>
            <li><a href="../../../admin_landing_page.php#contact">Contact</a></li>
            <li><a href="#">Tour</a></li> 
            <li class="dropdown"><a><span>Portal</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="../../../php/Portal/Admin/login.php">Login</a></li>
                <li><a href="../../../php/Portal/Admin/signup.php">Signup</a></li>
                <li><a href="../../../php/Portal/Admin/forgot_password.php">Forgot Password</a></li>
              </ul>
            </li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>

    </div>

  </header>

  <section id="login">
    <div class="center">
      <h1>Signup</h1>
      <!-- Validation message section -->
      <?php

      // Check if there are any error messages
      if (isset($_SESSION['error'])) {
        echo '<div class="error_message">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']); // Clear the error message
      }

      // Check if there are any success messages
      if (isset($_SESSION['success'])) {
        echo '<div class="success_message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']); // Clear the success message
      }
      ?>

      <form method="post" action="../../../db_con/admin_signup_con.php">
        <div class="txt_field">
          <input type="text" name="first_name" required>
          <span></span>
          <label>First Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="last_name" required>
          <span></span>
          <label>Last Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="department_name" required>
          <span></span>
          <label>Department Name</label>
        </div>
        <div class="txt_field">
          <input type="email" name="email" required>
          <span></span>
          <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="password" id="password" name="password" required>
          <span></span>
          <label>Password</label>
          <i class="bi bi-eye-slash" id="togglePassword1"></i>
        </div>
        <div class="txt_field">
          <input type="password" id="confirm_password" name="confirm_password" required>
          <span></span>
          <label>Confirm Password</label>
          <i class="bi bi-eye-slash" id="togglePassword2"></i>
        </div>
        <input type="submit" value="Signup">
        <div class="signup_link">
          Do you have Account? <a href="../../../php/Portal/Admin/login.php">Login</a>
        </div>
      </form>
    </div>
  </section>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
          <div class="footer-about">
            <a href="../../../admin_landing_page.php" class="logo sitename">
              <img src="../../../assets/img/green_tree_icon.png">
            </a>
            <div class="footer-contact pt-3">
              <p>3 Bagong Calzada,</p>
              <p>Pateros, 1620 Metro Manila</p>
              <p class="mt-3"><strong>Phone:</strong> <span>(02) 642 6181</span></p>
              <p><strong>Email:</strong> <span>info@gardenofmemories.ph</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href="https://www.facebook.com/profile.php?id=100064140905935"><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="../../../admin_landing_page.php#hero">Home</a></li>
            <li><a href="../../../admin_landing_page.php#about">About us</a></li>
            <li><a href="../../../admin_landing_page.php#contact">Contact</a></li>
            <li><a href="#">Tour</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Our Newsletter</h4>
          <p>Subscribe to our newsletter and receive the latest news about our services!</p>
          <form action="../../../db_con/news_letter_5.php" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <?php
                if (isset($_SESSION['error_message'])) {
                  echo '<div class="error_message">' . $_SESSION['error_message'] . '</div>';
                  unset($_SESSION['error_message']); // Clear the error message
                }
          
                // Display success messages
                if (isset($_SESSION['success_message'])) {
                  echo '<div class="success_message">' . $_SESSION['success_message'] . '</div>';
                  unset($_SESSION['success_message']); // Clear the success message
                }
            ?>
          </form>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Garden of Memories</strong> <span>All Rights
          Reserved</span></p>
      <div class="credits">
        2024
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/vendor/aos/aos.js"></script>
  <script src="../../../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../../../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../../../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="../../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="../../../assets/js/main.js"></script>

</body>

</html>