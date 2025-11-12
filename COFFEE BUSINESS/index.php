<?php
// ✅ Require authentication before viewing
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Muni-Muni Cafe | Home</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="loader">
    <video autoplay muted loop class="loader-video">
      <source src="videos/vid1.mp4">
      Your browser does not support the video tag.
    </video>
  </div>

  <header>
    <div class="header-left">
      <h1 class="logo">Muni-Muni Cafe</h1>
      <span class="welcome-text">
        Welcome, <?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>
      </span>
    </div>

    <nav>
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="myorders.php">My Orders</a></li>
      </ul>
    </nav>

    <div class="header-right">
      <a href="cart.php" class="cart-link">🛒 Cart</a>
      <a href="logout.php" class="logout-link">Logout</a>
    </div>
  </header>

  
  <section class="hero">
    <video autoplay muted loop playsinline class="bg-video">
      <source src="videos/1111.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    <div class="hero-content">
      <img src="images/white.png" alt="Muni-Muni Cafe Logo" class="hero-logo" />
      <h2>Take a Sip, Reflect, and Relax</h2>
      <p>Welcome to Muni-Muni Cafe — where every cup tells a story.</p>
      <a href="products.php" class="btn">Shop Now</a>
    </div>
  </section>

 
  <section class="welcome-section">
    <div class="welcome-text">
      <h1>Mabuhay, Coffee Lovers!</h1>
      <p>
        Muni-Muni Cafe is here to bring you freshly crafted coffee that warms the heart.
        We believe everyone deserves premium flavors at friendly prices.
        Handa ka na ba sa ultimate muni-muni coffee experience?
      </p>
      <a href="about.php" class="story-btn">Our Story</a>
    </div>

    <div class="welcome-image">
      <img src="images/showcase.png" alt="Muni-Muni Showcase" />
    </div>
  </section>

 
  <section class="follow-us">
    <h3>Follow us on</h3>
    <div class="social-icons">
      <a href="https://www.instagram.com/muni_muniph/" target="_blank" rel="noopener noreferrer">
        <img src="images/instagram.png" alt="Instagram" />
      </a>
      <a href="https://www.facebook.com/profile.php?id=61583556781633" target="_blank" rel="noopener noreferrer">
        <img src="images/facebook.png" alt="Facebook" />
      </a>
    </div>
  </section>

  
  <footer class="footer-info">
    <div class="footer-left">
      <p><strong>MUNI-MUNI CAFE PHILIPPINES</strong></p>
      <p>Business Registration No: 2025-GRC PROJECT - JAVIER</p>
      <p>COPYRIGHT 2025 © MUNI-MUNI CAFE</p>
    </div>

    <div class="footer-right">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Customer Support</a>
    </div>
  </footer>
</body>
<script>
window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    

    setTimeout(() => {
        loader.classList.add('hide');
    }, 1000); 
});
</script>



</html>