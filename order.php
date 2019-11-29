<?php session_start();
$quantity = $_POST['quantity'];
$prod_id = $_POST['prod_id'];
$cart = $_SESSION['cart'];
$cart[$prod_id] = $quantity;
$_SESSION['cart'] = $cart;
//header("Location:orders.php");

