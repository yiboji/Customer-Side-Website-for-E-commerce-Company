<?php
$productID=$_GET['productID'];
$con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
or die('Unable to connect');
$select = mysql_select_db('users', $con)
or die('Could not select users');

if(strlen($productID)==0){
    $sql = "select * from product";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $productID=$row['productID'];
}
$sql = "select * from product where productID=$productID";
$sql_not = "select * from product where productID!=$productID";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Thanks for choosing BOSE</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/Quicksand_Book_400.font.js" type="text/javascript"></script>
    <script type="text/javascript">
        Cufon.replace('h1,h2');
    </script>
</head>

<div id="body">
<!--<h1 class="title">Sign In(<span id="bag-quantity"></span>)</h1>-->

<div class="pg_content">
    <div id="pg_title" class="pg_title">
<?php

    $res = mysql_query($sql)
        or die('Invalid query'.$sql);
    $row = mysql_fetch_array($res);
    echo "<h1 id='head'".$row['productID']."' style='display:block;top:25px;'>".$row['productname']."</h1>";
?>
    </div>
    <div id="pg_desc1" class="pg_description">
        <?php
        $res = mysql_query($sql)
        or die('Invalid query'.$sql);
        $row = mysql_fetch_array($res);
        echo "<div id='description'".$row['productID']."' style='display:block;left:350px'><h2>Product Description</h2><table>
                <tr><td>Product: </td><td>".$row['productname']."</td></tr>
                <tr><td>Price:$ </td><td>".$row['pricerange']."</td></tr>
                <tr><td>Description: </td><td>".$row['description']."</td></tr>
                </table>
                </div>";
        ?>
    </div>
    <div id="pg_preview">
        <?php
        $res = mysql_query($sql)
        or die('Invalid query'.$sql);
        $row = mysql_fetch_array($res);
        echo "<img class='pg_thumb' style='display:block;z-index:5;' src='".$row['productimg']."'/>";
        ?>
    </div>
    <div id="pg_desc2" class="pg_description">
        <?php
        $res = mysql_query($sql)
        or die('Invalid query');
        $row = mysql_fetch_array($res);
        echo "<div id='addtocart'".$row['productID']."' style='display:block;left:350px'><a style='color:white;font-size:150%' href='javascript:addToCart(".$row['productID'].");' id='".$row['productID']."'>ADD TO CART</a></div>";
        ?>
    </div>
</div>

<!-- The JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script>
    $(document).ready(doReady);
    function doReady(){
        $(".title").click(function(){
            $(".bag").slideToggle();
        });
    }
</script>
<script type="text/javascript">

</script>
</div>
</html>