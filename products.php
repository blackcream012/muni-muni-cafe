<?php

include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muni-Muni Cafe | Products</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>
            </span>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php" class="active">Products</a></li>
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

   
    <section class="products">
        <h2>A Brew to Match Your Muni-Muni Moments</h2>
        <p class="subtitle">Whether you’re lost in thought or catching up with friends, Muni-Muni Café has the perfect drink for every reflection.</p>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">

              
                <div class="swiper-slide product-card">
                    <img src="images/cup1.png" alt="Caramel Latte">
                    <h3>Muni-Berry Cheesecake</h3>
                    <div class="divider"></div>
                    <p class="desc">Iced / Hot</p>
                    <p class="price">₱120</p>
                    <div class="buttons">
                        <button class="cart-btn" data-name="Muni-Berry Cheesecake" data-price="120" data-image="images/cup1.png">Add to Cart</button>
                    </div>
                </div>

            
                <div class="swiper-slide product-card">
                    <img src="images/cup2.png" alt="Chocolate Mocha">
                    <h3>Muni Executive Latté</h3>
                    <div class="divider"></div>
                    <p class="desc">Iced / Hot</p>
                    <p class="price">₱140</p>
                    <div class="buttons">
                        <button class="cart-btn" data-name="Muni Executive Latté" data-price="140" data-image="images/cup2.png">Add to Cart</button>
                    </div>
                </div>

               
                <div class="swiper-slide product-card">
                    <img src="images/cup3.png" alt="Classic Espresso">
                    <h3>Muni Spanish Latté</h3>
                    <div class="divider"></div>
                    <p class="desc">Hot</p>
                    <p class="price">₱100</p>
                    <div class="buttons">
                        <button class="cart-btn" data-name="Muni Spanish Latté" data-price="100" data-image="images/cup3.png">Add to Cart</button>
                    </div>
                </div>

                
                <div class="swiper-slide product-card">
                    <img src="images/cup4.png" alt="Caramel Latte">
                    <h3>Triple Muni Jelly</h3>
                    <div class="divider"></div>
                    <p class="desc">Iced / Hot</p>
                    <p class="price">₱120</p>
                    <div class="buttons">
                        <button class="cart-btn" data-name="Triple Muni Jelly" data-price="120" data-image="images/cup4.png">Add to Cart</button>
                    </div>
                </div>

                
                <div class="swiper-slide product-card">
                    <img src="images/cup5.png" alt="Chocolate Mocha">
                    <h3>Calm Irish Cream</h3>
                    <div class="divider"></div>
                    <p class="desc">Iced / Hot</p>
                    <p class="price">₱140</p>
                    <div class="buttons">
                        <button class="cart-btn" data-name="Calm Irish Cream" data-price="140" data-image="images/cup5.png">Add to Cart</button>
                    </div>
                </div>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

  
    <div id="coffeeModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Customize your coffee</h2>
            <p id="modalProductName"></p>

            <label>
                Temperature:
                <select id="coffeeTemp">
                    <option value="Hot">Hot</option>
                    <option value="Iced">Iced</option>
                </select>
            </label>

            <label>
                Sugar (%):
                <select id="coffeeSugar">
                    <option value="0%">0%</option>
                    <option value="25%">25%</option>
                    <option value="50%">50%</option>
                    <option value="75%">75%</option>
                    <option value="100%">100%</option>
                </select>
            </label>

            <div class="modal-buttons">
                <button id="cancelBtn">Cancel</button>
                <button id="addCartBtn">Add to Cart</button>
            </div>
        </div>
    </div>

   
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

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
   
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });

    
    let selectedProduct = {};
    const modal = document.getElementById("coffeeModal");

    document.querySelectorAll(".cart-btn").forEach(button => {
        button.addEventListener("click", () => {
            selectedProduct = {
                name: button.dataset.name,
                price: button.dataset.price,
                image: button.dataset.image
            };
            document.getElementById("modalProductName").textContent = selectedProduct.name;
            modal.style.display = "flex";
        });
    });

    document.querySelector(".close").onclick = () => modal.style.display = "none";
    document.getElementById("cancelBtn").onclick = () => modal.style.display = "none";

    document.getElementById("addCartBtn").onclick = () => {
        const temp = document.getElementById("coffeeTemp").value;
        const sugar = document.getElementById("coffeeSugar").value;
        selectedProduct.temp = temp;
        selectedProduct.sugar = sugar;

        fetch("add_to_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(selectedProduct)
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    html: `<strong>${selectedProduct.name}</strong><br>(${temp}, Sugar: ${sugar}%)`,
                    confirmButtonText: 'OK'
                });
            }
            modal.style.display = "none";
        });
    };

   
    window.onclick = function(event) {
        if (event.target == modal) modal.style.display = "none";
    };

  
    window.addEventListener('load', function() {
        const loader = document.getElementById('loader');
        setTimeout(() => loader.classList.add('hide'), 1000);
    });
    </script>
</body>
</html>
