<?php
session_start();
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$orderType = $data['orderType'] ?? '';
$fullName = $data['fullName'] ?? '';
$address = $data['address'] ?? '';
$contact = $data['contact'] ?? '';
$email = $data['email'] ?? '';
$paymentRef = $data['paymentRef'] ?? '';
$cart = $data['cart'] ?? [];
$user = $_SESSION['user'] ?? 'Guest';

$orderId = 'ORD'.rand(1000,9999);

$total = 0;
foreach($cart as $item){
    $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
}


$cart_json = json_encode($cart);


$stmt = $pdo->prepare("INSERT INTO orders (order_id, user, order_type, full_name, address, contact, email, payment_ref, cart, total) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$orderId, $user, $orderType, $fullName, $address, $contact, $email, $paymentRef, $cart_json, $total]);


$_SESSION['cart'] = [];

echo json_encode(['status'=>'success','orderId'=>$orderId]);
?>
