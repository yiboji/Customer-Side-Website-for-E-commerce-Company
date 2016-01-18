<?php
session_start();
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/6/15
 * Time: 10:16 PM
 */
session_start();
$username=$_POST['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$password=$_POST['password'];
$address=$_POST['address'];
$zipcode=$_POST['zipcode'];
$cardnumber=$_POST['cardnumber'];
$expiredate=$_POST['expiredate'];

if (strlen($username) == 0) {
    $errmsg = 'Invalid input';
} else if (strlen($password) == 0) {
    $errmsg = 'Invalid input';
} else if (strlen($firstname) == 0) {
    $errmsg = 'Invalid input';
}else if (strlen($lastname) == 0) {
    $errmsg = 'Invalid input';
}else if (strlen($address) == 0) {
    $errmsg = 'Invalid input';
}else if (strlen($cardnumber) == 0) {
    $errmsg = 'Invalid input';
}else if (strlen($zipcode) == 0) {
    $errmsg = 'Invalid input';
}else if (strlen($expiredate) == 0) {
    $errmsg = 'Invalid input';
}

if (strlen($errmsg) > 0) {
    echo $errmsg;
} else {
    //good to add
    $sql = "insert into customer (username,firstname, lastname, password, address, zipcode, cardnumber, expiredate)
                value ('$username','$firstname','$lastname','$password','$address','$zipcode','$cardnumber','$expiredate')";
    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
    or die('Unable to connect');
    mysql_select_db('users');
    $res = mysql_query($sql)
    or die('Invalid query');
    $_SESSION["username"] = $username;
    $_SESSION["expiretime"] = time()+300;
    header("Location:mainpage.php");
}
