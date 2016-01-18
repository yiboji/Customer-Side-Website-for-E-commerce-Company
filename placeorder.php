<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/8/15
 * Time: 11:35 PM
 */

session_start();

$totalprice = 0;

echo "<h2>Your Order</h2>";
echo" <table border='1'><tr><td>Product</td><td>Price</td><td>Quantity</td></tr>";
if(isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $key => $value) {
        $price = 0;
        $sql = "select * from product where productID=$key";
        $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
        or die("unable to connect mysql");
        $select = mysql_select_db('users', $con)
        or die('Could not select users');
        $res = mysql_query($sql)
        or die('Invalid query');
        $row = mysql_fetch_array($res);

        echo '<tr>';
        echo '<td>' . $row['productname'] . '</td>';

        $sql = "select * from specialsale where productID=$key";
        $res = mysql_query($sql)
        or die('Invalid query');
        $row_special = mysql_fetch_array($res);
        if ($row_special) {
            $price = $row_special['discount'] * $row['pricerange'] / 100;
            echo '<td>
                    <span style="text-decoration: line-through">$' . $row['pricerange'] . '</span>
                    <span style="color:red">  $' . $price . '</span>';
        } else {
            $price = $row['pricerange'];
            echo '<td>$' . $price . '</td>';
        }

        echo '<td>' . $value . '</td>';
        echo '</tr>';
        $totalprice += $price * $value;
    }
}
echo "<tr ><td colspan='3'>TOTAL PRICE: $ $totalprice</td></tr>";
echo '</table>';
echo '<input class="button" type="button" onclick="javascirpt:checkout();" value="Check Out"/>&nbsp&nbsp';

echo '<input class="button" id="placeorder-cancel" onclick="javascript:cancelPlaceOrder();" type="button" value="CANCEL"/>';