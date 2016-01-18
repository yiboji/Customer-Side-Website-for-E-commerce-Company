<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/8/15
 * Time: 10:36 PM
 */

session_start();

if(strlen($_SESSION['username'])==0){
    echo 'false';
}
else{
    $sql = "select * from customer where username='".$_SESSION['username']."'";
    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
    or die("unable to connect mysql");
    $select = mysql_select_db('users', $con)
    or die('Could not select users');
    $res = mysql_query($sql)
    or die('Invalid query');
    $row = mysql_fetch_array($res);

    $customerID = $row['customerID'];
    date_default_timezone_set("America/Los_Angeles");
    $orderdate = date("Y-m-d");


    $sql = "insert into orderdate(customerID,orderdate) value('$customerID','$orderdate')";
    $res = mysql_query($sql)
        or die('Invalid query'.$sql);

    $orderID = mysql_insert_id();
    foreach($_SESSION['cart'] as $key => $value) {
        $sql = "insert into orders(orderID, productID,quantity) value('$orderID','$key','$value')";
        $res = mysql_query($sql)
            or die('Invalid query'.$sql);
    }
    echo 'success';
}