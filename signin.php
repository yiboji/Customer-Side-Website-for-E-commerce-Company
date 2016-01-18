<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/7/15
 * Time: 1:42 AM
 */
session_start();

$username=$_POST['username'];
$password=$_POST['password'];

if (strlen($username) == 0) {
    $errmsg = 'Invalid input';
} else if (strlen($password) == 0) {
    $errmsg = 'Invalid input';
}


if (strlen($errmsg) > 0) {
    echo $errmsg;
} else {
    $sql = "select * from customer where username='$username' and password='$password'";
    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
        or die('Unable to connect');
    mysql_select_db('users');
    $res = mysql_query($sql)
        or die('Invalid query'.$sql);
    if(!($row=mysql_fetch_array($res))){
        echo 'Invalid username or password';
    }
    else{
        $_SESSION["username"] = $row['username'];
        $_SESSION["expiretime"] = time()+300;
        echo 'success';
    }
}