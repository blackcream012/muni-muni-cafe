<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About | Muni-Muni Cafe</title>
    <link rel="stylesheet" href="style.css">
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
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="myorders.php">My Orders</a></li>
            </ul>
        </nav>

        <div class="header-right">
            <a href="cart.php" class="cart-link">🛒 Cart</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>

    </header>

    <section class="about">
        <h2>Our Story</h2>
        <p>Muni-Muni Cafe was founded with a simple mission — to create a cozy space where people can slow down, reflect, and enjoy every sip of coffee. Each cup we brew is made with love, passion, and mindfulness.</p>
    </section>

    <section class="follow-us">
        <h3>Follow us on</h3>
        <div class="social-icons">
            <a href="#" target="_blank"><img src="images/instagram.png" alt="Instagram"></a>
            <a href="#" target="_blank"><img src="images/facebook.png" alt="Facebook"></a>
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