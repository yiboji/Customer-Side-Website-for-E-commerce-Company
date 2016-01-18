<?php
/**
 * Created by PhpStorm.
 * User: yiboji
 * Date: 7/7/15
 * Time: 12:14 AM
 */
session_start();
session_destroy();
if(isset($_GET['timeout']))
    header("Location:mainpage.php?timeout=timeout");
else
    header("Location:mainpage.php");