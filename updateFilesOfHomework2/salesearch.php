<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/9/15
 * Time: 3:55 AM
 */

$type = $_GET['type'];
$con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
or die("unable to connect mysql");
$select = mysql_select_db('users', $con)
or die('Could not select users');

$product_quantity =  array();
$sql = "select * from orders";
$res = mysql_query($sql)
or die('Invalid query' . $sql);
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

if($type=='date'){
    $date = $_GET['date'];
    $sql = "select * from orderdate where orderdate='$date'";
    $res = mysql_query($sql)
        or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();

    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $orderID = $row['orderID'];
        $sql = "select * from orders where orderID=$orderID";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($productid_array[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                    or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:165px'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                    $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];
            }
            $productid_array[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}
else if($type=='category'){
    $productcategory = $_GET['category'];

    $sql = "select * from product where productcategoryID='$productcategory'";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();
    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $productID = $row['productID'];
        $sql = "select * from orders where productID=$productID";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($productid_array[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:165px'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];
            }
            $productid_array[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}
else if($type=='specialsale'){
    $sql = "select * from specialsale";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();
    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $productID = $row['productID'];
        $sql = "select * from orders where productID=$productID";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($productid_array[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:165px'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];

            }
            $productid_array[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}
else if($type=='allproduct'){
    $sql = "select * from product";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();
    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $productID = $row['productID'];
        $sql = "select * from orders where productID=$productID";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($productid_array[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:165px'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];
            }
            $productid_array[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}
else if($type=='quantity'){
    $sql = "select * from orders";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();
    $product_prevent = array();
    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $productID = $row['productID'];
        if(!isset($productid_array[$productID]))
            $productid_array[$productID] = $row['quantity'];
        else
            $productid_array[$productID] += $row['quantity'];
    }
    arsort($productid_array);
    foreach($productid_array as $key => $value){
        $sql = "select * from orders where productID=$key";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($product_prevent[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:170px;overflow:scroll'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];
            }
            $product_prevent[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}
else if($type=='price'){
    $sql = "select * from orders";
    $res = mysql_query($sql)
    or die('Invalid query' . $sql);
    $startleft = 8;
    $starttop = 0;
    $shift = 1;
    $positionleft = $startleft;
    $positiontop = $starttop;
    $count = 0;
    $productid_array = array();
    $product_prevent = array();
    $totalprice = 0;
    while ($row = mysql_fetch_array($res)){
        $productID = $row['productID'];
        if(!isset($productid_array[$productID]))
            $productid_array[$productID] = $row['quantity'];
        else
            $productid_array[$productID] += $row['quantity'];
    }

    foreach($productid_array as $key => $value){
        $sql = "select * from product where productID=$key";
        $result_product = mysql_query($sql)
        or die('Invalid query' . $sql);
        $row_product = mysql_fetch_array($result_product);
        $productid_array[$key]=$row_product['pricerange']*$value;
    }
    arsort($productid_array);
    foreach($productid_array as $key => $value){
        $sql = "select * from orders where productID=$key";
        $result = mysql_query($sql)
        or die('Invalid query' . $sql);
        while($row_productid=mysql_fetch_array($result)){
            $productid=$row_productid['productID'];

            if($product_prevent[$productid]!=1){
                $sql = "select * from product where productID=$productid";
                $result_product = mysql_query($sql)
                or die('Invalid query' . $sql);
                $row_product = mysql_fetch_array($result_product);

                echo "<div class='frame' style='position:absolute;left:$positionleft%;top:$positiontop'>
                <div class='item' style='background-image: url(\"".$row_product['productimg']."\");position:relative;left:10%;top:15%;width:266px;height:165px'>
                <div>";
                echo "Product ID: ".$row_product['productID'].";<br>";
                echo "Product Name: ".$row_product['productname'].";<br>";
                $sql="select * from productcategory where productcategoryID=".$row_product['productcategoryID'];
                $result_category=mysql_query($sql)
                or die('Invalid query for productcategory');
                $caterow = mysql_fetch_array($result_category);
                echo "Product Category: ".$caterow['categoryname'].";<br>";
                echo "Description: ".$row_product['description'].";<br>";
                echo "Price: $".$row_product['pricerange'].";<br>";
                echo "Discount:".$product_discount[$productid].";<br>";
                echo "Total Sale Price:".$product_sale[$productid].";<br/>";
                echo "Total Sale Quantity:".$product_quantity[$productid].";<br/>";
                echo "</div>
                </div>
                </div>";
                $count++;
                if($count==3) {
                    $positionleft = $startleft;
                    $positiontop += 250;
                    $count = 0;
                }
                else{
                    $positionleft += ($shift+30);
                }
                $totalprice += $product_sale[$productid];
            }
            $product_prevent[$productid] = 1;
        }
    }
    echo "<span style='font-family:Comic Sans MS; color:white;'>Total Sale:<br/> $$totalprice</span>";
}