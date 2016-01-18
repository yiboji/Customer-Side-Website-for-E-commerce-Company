<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/6/15
 * Time: 11:37 PM
 */
$con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
        or die('Unable to connect');
mysql_select_db('users');
//customer table;
$sql = "CREATE TABLE customer(".
    "customerID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,".
    "username text,".
    "firstname text,".
    "lastname text,".
    "password VARCHAR(18),".
    "address text,".
    "zipcode INT(5),".
    "cardnumber text,".
    "expiredate DATE);";
$res = mysql_query($sql,$con)
        or die('Invalid query'.$sql);

$sql = "CREATE TABLE orders(".
    "orderID INT,".
    "productID INT(11),".
    "quantity INT(11));";
$res = mysql_query($sql,$con)
    or die('Invalid query'.$sql);

$sql = "CREATE TABLE orderdate(".
    "orderID INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,".
    "customerID INT(11),".
    "orderdate DATE)";
$res = mysql_query($sql,$con)
    or die('Invalid query'.$sql);


