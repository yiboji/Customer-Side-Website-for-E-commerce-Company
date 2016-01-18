<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/9/15
 * Time: 2:31 AM
 */
session_start();

if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}

$totalprice = 0;
echo" <table><tr><td>Product</td><td>Price</td><td>Quantity</td></tr>";
echo "<tr><td>TOTAL PRICE:</td><td>$ $totalprice</td></tr>";
echo '</table>';
