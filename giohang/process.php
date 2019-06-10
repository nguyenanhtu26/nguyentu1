<?php
session_start();
echo '<pre>';
print_r($_POST);
echo '<pre>';
require_once('database.php');
$database = new Database();
if (!isset($_POST) && !isset($_POST)) {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                if (isset($_POST['quantity']) && isset($_POST['product_id'])) {
                    $sql = "SELECT *FROM products WHERE  id=" . (int)$_POST['product_id'];
                    $product = $database->runQuery($sql);
                    $product = current($product);
                    $product_id = $product['id'];
                    if (isset($_SESSION) && !empty($_SESSION['cart_item'])) {
                        if (isset($_SESSION['cart_item'][$product_id])) {
                            $exist_cart_item = $_SESSION['cart_item'][$product_id];
                            $exist_quantity = $exist_cart_item['quantity'];
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['product_name'] = $product['product_name'];
                            $cart_item['product_image'] = $product['product_image'];
                            $cart_item['price'] = $product['price'];
                            $cart_item['quantity'] = $_POST['quantity'] + $exist_quantity;
                            $_SESSION['cart_item'][$product_id] = $cart_item;

                        } else {
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['product_name'] = $product['product_name'];
                            $cart_item['product_image'] = $product['product_image'];
                            $cart_item['price'] = $product['price'];
                            $cart_item['quantity'] = $product['quantity'];
                            $_SESSION['cart_item'][$product_id] = $cart_item;
                        }

                    } else {
                        $_SESSION['cart_item'] = array();
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['product_name'] = $product['product_name'];
                        $cart_item['product_image'] = $product['product_image'];
                        $cart_item['price'] = $product['price'];
                        $cart_item['quantity'] = $product['quantity'];
                        $_SESSION['cart_item'][$product_id] = $cart_item;
                    }

                }
                break;
            default:
                echo 'khong ton tai';
                die;
        }
    }
}
header("Location: http://btvn.demo/");

die;