<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'] ?? '';
$price = $data['price'] ?? 0;
$image = $data['image'] ?? '';
$temp = $data['temp'] ?? '';
$sugar = $data['sugar'] ?? '';

if ($name && $price) {
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
  
        if ($item['name'] === $name && $item['temp'] === $temp && $item['sugar'] === $sugar) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'temp' => $temp,
            'sugar' => $sugar,
            'quantity' => 1
        ];
    }
}

echo json_encode([
    'status' => 'success',
    'cart_count' => array_sum(array_column($_SESSION['cart'], 'quantity'))
]);
?>
