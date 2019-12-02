<?php session_start();
$cart = $_POST['order'];
//$cart = $_SESSION['cart'];
//$cart[$prod_id] = $quantity;
$_SESSION['cart'] = $cart;
//header("Location:orders.php");

