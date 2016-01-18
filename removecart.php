<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/8/15
 * Time: 4:00 AM
 */
session_start();
$productID = $_GET['productID'];

$_SESSION['cart'][$productID]--;
if($_SESSION['cart'][$productID]==0){
    unset($_SESSION['cart'][$productID]);
}
$totalprice = 0;
echo" <table cellpadding='10' style='border:1px solid black'><tr>
                                <td style='border-bottom: 1px solid black'>Product</td>
                                <td style='border-bottom: 1px solid black'>Price</td>
                                <td style='border-bottom: 1px solid black'>Quantity</td>
                                <td style='border-bottom: 1px solid black'>Action</td>
                                </tr>";
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $value){
        $sql = "select * from product where productID=$key";
        $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
        or die("unable to connect mysql");
        $select = mysql_select_db('users', $con)
        or die('Could not select users');
        $res = mysql_query($sql)
        or die('Invalid query');
        $row = mysql_fetch_array($res);

        echo '<tr style="border-bottom: 1px solid black">';
        echo '<td style="border-bottom: 1px solid black">'.$row['productname'].'</td>';

        $sql = "select * from specialsale where productID=$key";
        $res = mysql_query($sql)
        or die('Invalid query');
        $row_special = mysql_fetch_array($res);
        echo '<td style="border-bottom: 1px solid black">';
        if($row_special){
            $price = $row_special['discount']*$row['pricerange']/100;
            echo '<span style="text-decoration: line-through">$'.$row['pricerange'].'</span>
                                            <span style="color:red">  $'.$price.'</span>';
        }
        else{
            $price = $row['pricerange'];
            echo '$'.$price;
        }
        echo '</td>';

        echo '<td style="border-bottom: 1px solid black">'.$value.'</td>';
        echo '<td style="border-bottom: 1px solid black"><input type="button" value="add" onclick="javascirpt:addToCart('.$key.')"/>';
        echo '<input type="button" value="subtract" onclick="javascirpt:removeCart('.$key.')"/></td>';
        echo '</tr>';
        $totalprice += $price*$value;
    }
}
echo "<tr><td>TOTAL PRICE: $$totalprice</td></tr>";
echo '</table>';

echo "<h2>Others also buy</h2>";

if(isset($_SESSION['cart'])) {
    echo '<table border="1">';
    $productid_array = array();
    foreach($_SESSION['cart'] as $key => $value){
        $sql = "select * from orders where productID=$key";
        $res = mysql_query($sql)
        or die('Invalid query');
        while($row = mysql_fetch_array($res)){
            $orderID = $row['orderID'];
            $sql = "select * from orders where orderID=$orderID and productID!=$key";
            $result = mysql_query($sql)
            or die('Invalid query');
            while($row_productid=mysql_fetch_array($result)){
                $otherprudctID = $row_productid['productID'];
                if($productid_array[$otherprudctID]!=1){
                    $sql = "select * from product where productID=$otherprudctID";
                    $result_product = mysql_query($sql)
                    or die('Invalid query');
                    $row_product = mysql_fetch_array($result_product);
                    echo "<tr>";
                    echo "<td>".$row_product['productname']."</td>";
                    echo "<td><img width='50px' height='50px' src='".$row_product['productimg']."'/></td>";
                    echo "</tr>";
                    $productid_array[$otherprudctID]=1;
                }
            }
        }
    }
    echo '</table>';
}
