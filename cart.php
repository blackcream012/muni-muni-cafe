<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

// Remove item
if (isset($_GET['remove'])) {
    unset($cart[$_GET['remove']]);
    $_SESSION['cart'] = array_values($cart);
    header("Location: cart.php");
    exit();
}

// Compute total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Muni-Muni Cafe | Cart</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f2efec;
            margin: 0;
            padding: 0;
        }

        .cart-page {
            max-width: 900px;
            margin: 80px auto;
            background-color: #fff8f3;
            padding: 40px 50px;
            border-radius: 20px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
        }

        .cart-title {
            text-align: center;
            font-size: 28px;
            color: #3b2f2f;
            margin-bottom: 35px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .cart-header,
        .cart-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            align-items: center;
            padding: 18px 0;
            border-bottom: 1px solid #efe7e0;
        }

        .cart-header {
            font-weight: 600;
            color: #4b3b33;
            font-size: 0.95rem;
        }

        .cart-row:hover {
            background-color: #fff3e9;
            transition: 0.3s;
        }

        .cart-product {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .cart-product img {
            width: 80px;
            border-radius: 10px;
        }

        .cart-info h3 {
            font-size: 1rem;
            margin-bottom: 4px;
            color: #3a2e2e;
        }

        .small-text {
            color: #777;
            font-size: 0.8rem;
        }

        .remove-link {
            color: #b23a3a;
            font-size: 0.85rem;
            text-decoration: underline;
            cursor: pointer;
        }

        .qty-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .qty-controls button {
            background: #3969a0;
            color: white;
            border: none;
            border-radius: 6px;
            width: 32px;
            height: 32px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .qty-controls button:hover {
            background: #2b4d78;
        }

        .qty-controls input {
            width: 50px;
            height: 32px;
            text-align: center;
            border: 1px solid #cbb79d;
            border-radius: 6px;
            background: #fffdf9;
            padding: 0;
        }

        .cart-summary {
            text-align: right;
            margin-top: 30px;
            font-size: 1rem;
            color: #4b2e1e;
        }

        .checkout-btn {
            background: #3969a0;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            margin-top: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .checkout-btn:hover {
            background: #2b4d78;
        }

        @media (max-width: 768px) {
            .cart-header {
                display: none;
            }

            .cart-row {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .cart-product {
                flex-direction: column;
            }

            .cart-summary {
                text-align: center;
            }
        }
    </style>
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

    <main class="cart-page">
        <h2 class="cart-title">Shopping Cart</h2>

        <?php if (empty($cart)): ?>
            <p class="empty-cart">Wanna muni-muni moments? Just add to cart! ☕</p>
        <?php else: ?>
            <div class="cart-header">
                <div>Product</div>
                <div>Price</div>
                <div>Quantity</div>
                <div>Total</div>
            </div>

            <?php foreach ($cart as $i => $item): ?>
                <div class="cart-row" data-index="<?= $i ?>" data-price="<?= $item['price'] ?>">
                    <div class="cart-product">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                        <div class="cart-info">
                            <h3><?= htmlspecialchars($item['name']) ?></h3>
                            <p class="small-text"><?= htmlspecialchars($item['temp'] ?? '') ?>, Sugar: <?= htmlspecialchars($item['sugar'] ?? '') ?>%</p>
                            <a href="?remove=<?= $i ?>" class="remove-link">Remove</a>
                        </div>
                    </div>

                    <div class="cart-price">₱<?= number_format($item['price'], 2) ?></div>

                    <div class="cart-qty">
                        <div class="qty-controls">
                            <button class="qty-minus">−</button>
                            <input type="number" class="qty-input" value="<?= $item['quantity'] ?>" min="1">
                            <button class="qty-plus">+</button>
                        </div>
                    </div>

                    <div class="cart-total">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></div>
                </div>
            <?php endforeach; ?>

            <div class="cart-summary">
                <p><strong>Subtotal:</strong> ₱<span id="subtotal"><?= number_format($total, 2) ?></span></p>
                <button class="checkout-btn">Proceed to Checkout</button>
            </div>
        <?php endif; ?>
    </main>

    <!-- Modern Checkout Modal -->
    <div id="checkoutModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:9999;">
        <div style="background:#fff; padding:30px 40px; border-radius:15px; width:90%; max-width:600px; position:relative; text-align:center;">
            <span class="close-checkout" style="position:absolute; top:10px; right:15px; font-size:24px; cursor:pointer;">&times;</span>
            <h2 style="margin-bottom:20px;">Checkout</h2>

            <!-- Step 1: Select Order Type -->
            <div id="orderTypeStep" style="display:flex; justify-content:center; gap:40px; margin-bottom:20px;">
                <div id="pickupOption" style="cursor:pointer; border:2px solid #ccc; border-radius:12px; padding:15px; width:150px; transition:0.3s;">
                    <img src="images/pickup.jpeg" alt="Pick-up" style="width:80px; margin-bottom:10px;">
                    <p>Pick-up</p>
                </div>
                <div id="deliveryOption" style="cursor:pointer; border:2px solid #ccc; border-radius:12px; padding:15px; width:150px; transition:0.3s;">
                    <img src="images/delivery.png" alt="Delivery" style="width:80px; margin-bottom:10px;">
                    <p>Delivery</p>
                </div>
            </div>

            <!-- Step 2: Pick-up Payment -->
            <div id="pickupPaymentStep" style="display:none; text-align:left; margin-top:20px;">
                <h3>Pick-up Order</h3>
                <p>Total: ₱<span id="pickupTotal"></span></p>
                <p>Select Payment:</p>
                <div style="display:flex; gap:15px; margin-bottom:15px;">
                    <button id="payGcashPickup" style="padding:10px 20px; background:#007DFE; color:#fff; border:none; border-radius:6px; cursor:pointer;">GCash</button>
                    <button id="payMayaPickup" style="padding:10px 20px; background:#50B16B; color:#fff; border:none; border-radius:6px; cursor:pointer;">Maya</button>
                </div>
                <div id="pickupQRCode" style="display:none; text-align:center;">
                    <img id="pickupQR" src="images/qr.jpg" alt="QR Code" style="width:200px; margin-bottom:10px;">
                    <input type="text" id="pickupRef" placeholder="Enter payment reference number" style="width:100%; padding:10px; border-radius:6px; margin-bottom:10px;">
                    <button id="confirmPickup" style="padding:10px 20px; background:#28a745; color:#fff; border:none; border-radius:6px;">Payment Sent</button>
                </div>
            </div>

            <!-- Step 2: Delivery Form -->
            <div id="deliveryFormStep" style="display:none; text-align:left; margin-top:20px;">
                <h3>Delivery Order</h3>
                <p>Total: ₱<span id="deliveryTotal"></span></p>
                <input type="text" id="fullName" placeholder="Full Name" style="width:100%; padding:10px; margin:5px 0; border-radius:6px;">
                <input type="text" id="address" placeholder="Address to Deliver" style="width:100%; padding:10px; margin:5px 0; border-radius:6px;">
                <input type="text" id="contact" placeholder="Contact Number" style="width:100%; padding:10px; margin:5px 0; border-radius:6px;">
                <input type="email" id="email" placeholder="Email" style="width:100%; padding:10px; margin:5px 0; border-radius:6px;">
                <p>Select Payment:</p>
                <div style="display:flex; gap:15px; margin-bottom:15px;">
                    <button id="payGcashDelivery" style="padding:10px 20px; background:#007DFE; color:#fff; border:none; border-radius:6px; cursor:pointer;">GCash</button>
                    <button id="payMayaDelivery" style="padding:10px 20px; background:#50B16B; color:#fff; border:none; border-radius:6px; cursor:pointer;">Maya</button>
                </div>
                <div id="deliveryQRCode" style="display:none; text-align:center;">
                    <img id="deliveryQR" src="images/qr.jpg" alt="QR Code" style="width:200px; margin-bottom:10px;">
                    <input type="text" id="deliveryRef" placeholder="Enter payment reference number" style="width:100%; padding:10px; border-radius:6px; margin-bottom:10px;">
                    <button id="confirmDelivery" style="padding:10px 20px; background:#28a745; color:#fff; border:none; border-radius:6px;">Payment Sent</button>
                </div>
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

    <script>
        // Cart quantity update
        document.querySelectorAll(".cart-row").forEach(row => {
            const price = parseFloat(row.dataset.price);
            const qtyInput = row.querySelector(".qty-input");
            const minusBtn = row.querySelector(".qty-minus");
            const plusBtn = row.querySelector(".qty-plus");
            const totalEl = row.querySelector(".cart-total");

            function updateTotal() {
                const qty = Math.max(1, parseInt(qtyInput.value));
                const newTotal = price * qty;
                totalEl.textContent = "₱" + newTotal.toFixed(2);
                updateSubtotal();
            }

            minusBtn.addEventListener("click", () => {
                qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
                updateTotal();
            });

            plusBtn.addEventListener("click", () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateTotal();
            });

            qtyInput.addEventListener("input", updateTotal);
        });

        function updateSubtotal() {
            let subtotal = 0;
            document.querySelectorAll(".cart-row").forEach(row => {
                const price = parseFloat(row.dataset.price);
                const qty = parseInt(row.querySelector(".qty-input").value);
                subtotal += price * qty;
            });
            document.getElementById("subtotal").textContent = subtotal.toFixed(2);
        }

        // Loader
        window.addEventListener('load', function() {
            const loader = document.getElementById('loader');
            setTimeout(() => { loader.classList.add('hide'); }, 1000);
        });

        // Modern Checkout Logic
        const checkoutModal = document.getElementById("checkoutModal");
        document.querySelector(".checkout-btn").addEventListener("click", () => {
            checkoutModal.style.display = "flex";
            const subtotal = parseFloat(document.getElementById("subtotal").textContent);
            document.getElementById("pickupTotal").textContent = subtotal.toFixed(2);
            document.getElementById("deliveryTotal").textContent = subtotal.toFixed(2);
        });

        document.querySelectorAll(".close-checkout").forEach(el => el.onclick = () => checkoutModal.style.display = "none");

        document.getElementById("pickupOption").onclick = () => {
            document.getElementById("orderTypeStep").style.display = "none";
            document.getElementById("pickupPaymentStep").style.display = "block";
        };
        document.getElementById("deliveryOption").onclick = () => {
            document.getElementById("orderTypeStep").style.display = "none";
            document.getElementById("deliveryFormStep").style.display = "block";
        };

        function showQRCode(type, method) {
            const qrSrc = method === "gcash" ? "images/qr.jpg" : "images/qr.jpg";
            if (type === "pickup") {
                document.getElementById("pickupQRCode").style.display = "block";
                document.getElementById("pickupQR").src = qrSrc;
            } else {
                document.getElementById("deliveryQRCode").style.display = "block";
                document.getElementById("deliveryQR").src = qrSrc;
            }
        }

        document.getElementById("payGcashPickup").onclick = () => showQRCode("pickup", "gcash");
        document.getElementById("payMayaPickup").onclick = () => showQRCode("pickup", "maya");
        document.getElementById("payGcashDelivery").onclick = () => showQRCode("delivery", "gcash");
        document.getElementById("payMayaDelivery").onclick = () => showQRCode("delivery", "maya");

        document.getElementById("confirmPickup").onclick = () => {
            const ref = document.getElementById("pickupRef").value;
            if (!ref) { alert("Please enter reference number"); return; }
            completeOrder("Pick-up", "", "", "", "", ref);
        };
        document.getElementById("confirmDelivery").onclick = () => {
            const fullName = document.getElementById("fullName").value;
            const address = document.getElementById("address").value;
            const contact = document.getElementById("contact").value;
            const email = document.getElementById("email").value;
            const ref = document.getElementById("deliveryRef").value;
            if (!fullName || !address || !contact || !email || !ref) {
                alert("Please complete all fields");
                return;
            }
            completeOrder("Delivery", fullName, address, contact, email, ref);
        };

        function completeOrder(type, fullName = "", address = "", contact = "", email = "", ref = "") {
            fetch("complete_order.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    orderType: type,
                    fullName, address, contact, email,
                    paymentRef: ref,
                    cart: <?= json_encode($_SESSION['cart'] ?? []) ?>
                })
            }).then(res => res.json())
                .then(data => {
                    if (data.status === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Order Completed!',
                            html: `<strong>Order ID:</strong> ${data.orderId}<br><strong>Payment Ref:</strong> ${ref}`,
                            showConfirmButton: true
                        });
                        checkoutModal.style.display = "none";
                        location.reload();
                    }
                });
        }
    </script>
</body>

</html>
