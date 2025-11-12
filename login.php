<?php
include 'config.php';
session_start();

function safe_echo($s) {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST['register'])) {
        $name = trim($_POST['fullname']); 
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password_plain = $_POST['password'];

        if (empty($name) || empty($email) || empty($password_plain)) {
            echo "<script>alert('Paki-fill ang required fields.');</script>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.');</script>";
        } else {
            
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<script>alert('Email already registered. Please log in.');</script>";
                $stmt->close();
            } else {
                $stmt->close();
                $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

                $insert_stmt = $conn->prepare("INSERT INTO users (`name`, email, phone, password) VALUES (?, ?, ?, ?)");
                $insert_stmt->bind_param("ssss", $name, $email, $phone, $password_hashed);
                $ok = $insert_stmt->execute();

                if ($ok) {
                    echo "<script>alert('Registration successful! You can now log in.');</script>";
                } else {
                   
                    echo "<script>alert('Error during registration. Please try again.');</script>";
                }
                $insert_stmt->close();
            }
        }
    }

  
    if (isset($_POST['login'])) {
        $email = trim($_POST['email']);
        $password_plain = $_POST['password'];

        if (empty($email) || empty($password_plain)) {
            echo "<script>alert('Paki-fill ang required fields.');</script>";
        } else {
            $stmt = $conn->prepare("SELECT id, `name`, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $name_db, $password_hashed);
                $stmt->fetch();

                if (password_verify($password_plain, $password_hashed)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user'] = $name_db;
                    echo "<script>alert('Welcome back, " . safe_echo($name_db) . "!'); window.location='index.php';</script>";
                    exit;
                } else {
                    echo "<script>alert('Incorrect password.');</script>";
                }
            } else {
                echo "<script>alert('Email not found. Please register first.');</script>";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Muni-Muni | Login & Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <div class="auth-container">
        <div class="left-side">
            <a href="login.php">
                <img src="images/580518803_122151102872838446_4820725885459250892_n.jpg" alt="Go back to home page" />
            </a>
        </div>
        <div class="right-side">
            <div class="logo">
                <div class="cup"></div>
                <h2>Muni-Muni<span> Cafe</span></h2>
            </div>

            <div class="tabs">
                <button class="tab active" id="login-tab">Login</button>
                <button class="tab" id="register-tab">Register</button>
            </div>

         
            <form id="login-form" class="form active" method="POST">
                <h3>Welcome Back! Please log in</h3>
                <label>Email address</label>
                <input type="email" name="email" placeholder="you@example.com" required />
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required />
                <div class="options">
                    <label><input type="checkbox" /> Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" name="login" class="btn main">Sign In</button>
            </form>

          
            <form id="register-form" class="form" method="POST">
                <h3>Create Your Account</h3>
                <label>Full Name</label>
               
                <input type="text" name="fullname" placeholder="Juan Dela Cruz" required />
                <label>Email address</label>
                <input type="email" name="email" placeholder="you@example.com" required />
                <label>Phone number</label>
                <input type="tel" name="phone" placeholder="+63 900 000 0000" required />
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required />
                <button type="submit" name="register" class="btn main">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');

        loginTab.addEventListener('click', () => {
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
            loginForm.classList.add('active');
            registerForm.classList.remove('active');
        });

        registerTab.addEventListener('click', () => {
            registerTab.classList.add('active');
            loginTab.classList.remove('active');
            registerForm.classList.add('active');
            loginForm.classList.remove('active');
        });
    </script>
</body>
</html>
