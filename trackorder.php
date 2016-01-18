<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/8/15
 * Time: 11:52 PM
 */
session_start();
if(strlen($_SESSION['username'])!=0){
    $sql = "select * from customer where username='".$_SESSION['username']."'";
    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
    or die("unable to connect mysql");
    $select = mysql_select_db('users', $con)
    or die('Could not select users');
    $res = mysql_query($sql)
    or die('Invalid query'.$sql);
    $row = mysql_fetch_array($res);
    $customerID = $row['customerID'];

    $sql = "select * from orderdate where customerID=$customerID";
    $res = mysql_query($sql)
    or die('Invalid query'.$sql);
    echo "<table border='1'>";
    echo '<tr>';
    echo '<th>Order ID</th>';
    echo '<th>Order Date</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    while($row = mysql_fetch_array($res)){
        echo '<tr>';
        echo '<td>'.$row['orderID'].'</td>';
        echo '<td>'.$row['orderdate'].'</td>';
        echo "<td><input type='button' value='Detail' onclick='javascript:showOrderDetail(".$row['orderID'].")' />";
        echo '</tr>';
    }
    echo "</table>";
    echo '<input class="button" onclick="javascript:closeTrack();" type="button" value="Close"/>';
}
else{
    echo "Please Log In";
    echo '<input class="button" onclick="javascript:closeTrack();" type="button" value="Close"/>';
}


