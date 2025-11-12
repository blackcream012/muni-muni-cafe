<?php
session_start();
include 'db.php';

$user = $_SESSION['user'] ?? 'Guest';


$stmt = $pdo->prepare("SELECT * FROM orders WHERE user=? ORDER BY created_at DESC");
$stmt->execute([$user]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Orders | Muni-Muni Cafe</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #f2efec;
            margin: 0;
            padding: 0;
        }

        .orders-page {
            max-width: 900px;
            margin: 80px auto;
            background: #fff8f3;
            padding: 40px;
            border-radius: 20px;
        }

        h2 {
            text-align: center;
            color: #3b2f2f;
        }

        .order {
            border: 1px solid #ccc;
            border-radius: 12px;
            margin-bottom: 20px;
            padding: 20px;
            background: #fffdf9;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-items {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .cart-item img {
            width: 50px;
            border-radius: 6px;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .item-text {
            line-height: 1.2;
        }

        .item-text small {
            color: #555;
        }

        .order-summary {
            margin-top: 10px;
            font-weight: 600;
        }

        @media(max-width:768px) {
            .order-header {
                flex-direction: column;
            }

            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-left">
            <h1 class="logo">Muni-Muni Cafe</h1>
            <span class="welcome-text">
                Welcome, <?= htmlspecialchars($_SESSION['user'] ?? 'Guest', ENT_QUOTES, 'UTF-8'); ?>
            </span>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="myorders.php" class="active">My Orders</a></li>
            </ul>
        </nav>

        <div class="header-right">
            <a href="cart.php" class="cart-link">🛒 Cart</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
    </header>

    <div class="orders-page">
        <h2>My Orders</h2>

        <?php if (empty($orders)): ?>
            <p style="text-align:center;">Wala ka pang orders. Simulan mo na ang iyong muni-muni moment! ☕</p>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order">
                    <div class="order-header">
                        <span><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id'] ?? 'N/A') ?></span>
                        <span><strong>Petsa:</strong> <?= htmlspecialchars($order['created_at'] ?? date('Y-m-d H:i:s')) ?></span>
                        <span><strong>Uri:</strong> <?= htmlspecialchars(ucfirst($order['order_type'] ?? 'N/A')) ?></span>
                    </div>


                    <div class="order-items">
                        <?php
                        $cart = json_decode($order['cart'], true) ?? [];
                        foreach ($cart as $item):
                        ?>
                            <div class="cart-item">

                                <div class="item-info">
                                    <img src="<?= htmlspecialchars($item['image'] ?? '') ?>" alt="<?= htmlspecialchars($item['name'] ?? '') ?>">
                                    <div class="item-text">
                                        <strong><?= htmlspecialchars($item['name'] ?? '') ?></strong><br>
                                        <small>
                                            <?= htmlspecialchars($item['temp'] ?? '') ?>
                                            <?= isset($item['sugar']) ? ' • Sugar: ' . htmlspecialchars($item['sugar']) : '' ?>
                                        </small>
                                    </div>
                                </div>


                                <div>
                                    ₱<?= number_format($item['price'] ?? 0, 2) ?> × <?= htmlspecialchars($item['quantity'] ?? 1) ?><br>
                                    <small>Total: ₱<?= number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="order-summary">
                        <?php
                        $total = 0;
                        foreach ($cart as $item) {
                            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                        }
                        ?>
                        <p><strong>Payment Ref:</strong> <?= htmlspecialchars($order['payment_ref'] ?? 'N/A') ?></p>
                        <p><strong>Kabuuang Halaga:</strong> ₱<?= number_format($total, 2) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
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
</body>

</html>