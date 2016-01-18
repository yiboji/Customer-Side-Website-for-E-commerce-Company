<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/8/15
 * Time: 11:52 PM
 */
session_start();

$orderID = $_GET['orderID'];

$con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
or die("unable to connect mysql");
$select = mysql_select_db('users', $con)
or die('Could not select users');
$sql = "select * from orders where orderID=$orderID";
$res = mysql_query($sql)
or die('Invalid query'.$sql);

$totalprice = 0;

$product_quantity =  array();
while ($row = mysql_fetch_array($res)){
    $productID = $row['productID'];
    if(!isset($productid_array[$productID]))
        $product_quantity[$productID] = $row['quantity'];
    else
        $product_quantity[$productID] += $row['quantity'];
}
$product_sale = array();
$product_discount = array();
foreach($product_quantity as $key=>$value){
    $sql = "select * from product where productID=$key";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $row = mysql_fetch_array($res);
    $sql = "select * from specialsale where productID=$key";
    $res_special = mysql_query($sql)
    or die('Invalid query' . $sql);
    $row_special = mysql_fetch_array($res_special);
    if(!$row_special)
        $product_sale[$key]=$value*$row['pricerange'];
    else{
        $product_sale[$key]=$value*$row['pricerange']*$row_special['discount']/100;
        $product_discount[$key] = $row_special['discount'];
    }
}
foreach($product_sale as $key=>$value){
    $totalprice += $value;
}

$sql = "select * from orders where orderID=$orderID";
$res = mysql_query($sql)
or die('Invalid query'.$sql);

echo "<table border='1'>";
echo "<tr>
        <td>Product Name</td>
        <td>Description</td>
        <td>Price</td>
        <td>Discount</td>
        <td>Image</td>
        <td>Quantity</td>
        </tr>";

while($row = mysql_fetch_array($res)){
    $productID = $row['productID'];
    $sql = "select * from product where productID=$productID";
    $result = mysql_query($sql)
    or die('Invalid query'.$sql);

    while($row_product=mysql_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row_product['productname'].'</td>';
        echo '<td>'.$row_product['description'].'</td>';
        echo '<td>$'.$row_product['pricerange'].'</td>';
        echo '<td>'.$product_discount[$row_product['productID']].'%</td>';
        echo '<td><img style="width:80px;height:80px" src="'.$row_product['productimg'].'"/></td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '</tr>';
    }
}
echo "<tr><td colspan='6'>Total: $".$totalprice."</td></tr>";
echo "</table>";


//echo '<input class="button" onclick="javascript:backToTrackorder();" type="button" value="Back"/>';
echo '<input class="button" onclick="javascript:backToTrackorder();" type="button" value="Close"/>';


