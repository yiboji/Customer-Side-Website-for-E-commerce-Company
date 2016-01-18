<?php
    session_start();
    $sessionID=session_id();
    if(!isset($_SESSION["username"])){
        $_SESSION["username"] = "";
    }
    else{
        if(time()>$_SESSION['expiretime']){
            header("Location:logout.php?timeout='timeout'");
        }
    }
?>
<!DOCTYPE HTML>
<html>

<head>
    <style type="text/css">
    </style>
    <style>
        html, body {
            weight: 100%;
            height: 100%;
            background-image: url(img/mainpage.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            font-size: 62.5%;
            font-family: "Trade Gothic Bold", Arial, Helvetica, sans-serif;
        }

        .hidebody{
            opacity:.9;
            background-color:#000;
        }

        header {
            color: #fff;
            /*border:solid 2px;*/
            width: 100%;
            z-index: 1000;
            height: 15%;
        }

        header .line-holder {
            overflow-x: hidden;
            padding: 2px 0;
            width: 100%;
            position: relative;
            top: 45%;

        }

        header .line {
            width: 40%;
            border-bottom: 1px solid #fff;
            height: 1px;
            position: absolute;
            opacity: 0.6;
        }

        header .leftline {
            left: 0px;
        }

        header .rightline {
            right: 0px;
        }

        header .logo {
            color: inherit;
            text-decoration: none;
            font-size: 300%;
            position: absolute;
            left: 40%;
            font-family: Tahoma;
            font-weight: bold;
            font-style: italic;
            margin-top: 32px;
            margin-left: -10px;
        }

        header .header-nav-right {
            text-decoration: none;
            float: right;
            margin-top: -1.4rem;
            position: relative;
            right: 40px;

        }

        header ul {
            list-style: none;
            letter-spacing: 1px;;
        }

        header .account > li {
            display: inline-block;
        }

        header .account-title {
            font-size: 250%;
            padding: 2rem;
        }

        header .account-detail {
            background-color: white;
            color: black;
            position: absolute;
            font-size: 250%;
            width: 100%;
            height: 82px;
            overflow: hidden;
        }

        header .account-detail ul > li{
            border-bottom: solid 1px gray;
            height: 30px;
            padding: 5px;
        }

        header .bag-title {
            font-size: 250%;
            padding: 2rem;
            margin-left: -1rem;
        }

        header .bag-detail {
            margin-left: -27.2rem;
            background-color: white;
            color: black;
            position: absolute;
            right:0px;
            font-size: 250%;
            width: auto;
            height: auto;
            max-height: 600px;
            padding:15px;
            z-index: 25;
            overflow:scroll;
        }

        header .bag-detail ul > li {
            height: 30px;
            padding: 10px;
        }

        .changetitle {
            background-color: white;
            color: black;
        }

        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 200%;
        }

        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none;
        }

        /* search input field */
        input[type=search] {
            background: #ededed url(img/search-icon.png) no-repeat 9px center;
            border: solid 1px #ccc;
            padding: 9px 10px 9px 32px;
            width: 55px;

            -webkit-border-radius: 10em;
            -moz-border-radius: 10em;
            border-radius: 10em;

            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            transition: all .5s;
        }

        input[type=search]:focus {
            width: 130px;
            background-color: #fff;
            border-color: #6dcff6;

            -webkit-box-shadow: 0 0 5px rgba(109, 207, 246, .5);
            -moz-box-shadow: 0 0 5px rgba(109, 207, 246, .5);
            box-shadow: 0 0 5px rgba(109, 207, 246, .5);
        }

        /* placeholder */
        input:-moz-placeholder {
            color: #999;
        }

        input::-webkit-input-placeholder {
            color: #999;
        }

        header .category-nav {
            position: absolute;
            top: 70px;
            font-size: 1.5rem;
            font-family: "Trade Gothic Condensed Bold", Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            transition: .75s top ease;
            width:60%;
        }
        .category-nav ul{
            padding:0;
        }
        #category-title > li {
            display: inline-block;
        }

        #category-title  > li > a {
            transition: color .3s ease;
        }

        #category-title  > li > a:hover {
            color: silver;
            opacity: .9;
            cursor: pointer;
            font-weight: bolder;
        }

        .play {
            width: 650px;
            height: 420px;
            overflow: hidden;
            position: relative;
            margin: 40px auto 0;
        }

        .play .text {
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            height: 60px;
        }

        .play .text div {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: black;
            filter: alpha(opacity:40);
            opacity: 0.4;
            z-index: 5;
        }

        .play .text span {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            line-height: 60px;
            color: white;
            z-index: 10;
            text-align: center;
            font-size: 20px;
        }

        .play ol {
            position: absolute;
            left: 37%;
            margin-left: -20px;
            bottom: 10px;
            z-index: 10;
        }

        .play ol li {
            float: left;
            margin-right: 3px;
            display: inline;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 9px;
            color: #fff;
            font-family: arial;
            font-size: 12px;
            border-radius: 100px;
        }

        .play ol li.active {
            font-weight: bold;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 1);
            position: relative;
        }

        .play ul {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .play ul li {
            width: 650px;
            height: 420px;
            float: left;
        }

        .play ul img {
            float: left;
            width: 650px;
            height: 420px;
        }

        #next {
            display: block;
            position: absolute;
            top: 38%;
            right: 0;
            width: 30px;
            height: 54px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 15;
            line-height: 50px;
            text-decoration: none;
        }

        #prev {
            display: block;
            position: absolute;
            top: 38%;
            left: 0;
            width: 30px;
            height: 54px;
            text-align: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 15;
            line-height: 50px;
            text-decoration: none;
        }

        #prev:hover .prevImg, #next:hover .nextImg {
            display: block;
        }

        .prevImg {
            height: 54px;
            width: 80px;
            position: absolute;
            background-color: #fff;
            top: 0;
            left: 30px;
            display: none;
        }

        .nextImg {
            height: 54px;
            width: 80px;
            position: absolute;
            background-color: #fff;
            top: 0;
            right: 30px;
            display: none;
        }
        .blur{
            width:100%;
            height:150%;
            z-index:20;
            display:none;
            background-color:#000;
            opacity:.8;
            position:absolute;
            left:0px;
            top:0px;
        }
        #signin:hover,
        #signup:hover,
        #myorder:hover,
        #editprofile:hover{
            background-color: #cccccc;
            cursor:pointer;
        }
        .signin{
            background-color:#fffef7;
            display:none;
            position: absolute;
            width:350px;
            height:270px;
            z-index:25;
            top:28%;
            left:34%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight:bold;
            padding-left:50px;
            padding-top:30px;
            padding-right:50px;
            padding-bottom: 30px;
        }
        .input{
            background-color:#fff;
            border:1px solid #e9e9e9;
            color:#333;
            padding:7px 0 7px 7px;
            box-shadow:inset 0 1px 0 0 rgba(204,204,204,1);
            width:250px;
        }
        .label{
            font-size:1.6rem;
            color:gray;
        }
        .button{
            font-size:15px;
            width:100px;
            height:30px;
            background-color:#999;
            color:#fff;
            border:1px solid #666;
        }
        h2{
            font-size:1.8rem;
            border-bottom:1px grey solid;
            text-transform: uppercase;
        }
        .signup,
        .placeorder,
        #trackorder,
        #orderdetail,
        .edit{
            background-color:#fffef7;
            display:none;
            position: absolute;
            width:565px;
            height:355px;
            z-index:25;
            top:23%;
            left:27%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight:bold;
            padding-left:50px;
            padding-top:30px;
            padding-right:50px;
            padding-bottom: 30px;

            overflow: scroll;
        }
        .userinfo{
            float:left;
            margin-top:1.4rem;
            font-size:250%;
        }
        .username{
            display:inline-block;
        }
        #logout{
            position:absolute;
            left:12%;
            color:white;
            font-size:100%;
            display:inline-block;
        }

        .category-detail{
            width:auto;
            height:auto;
            border:1px black solid;
            background:black;

            padding-left:0px;
            padding-bottom:25px;
            padding-right:0px;
        }
        .category-detail ul>li{
            padding-top:10px;
            border-bottom:white 1px solid;
            cursor:pointer;
        }
        .category-detail ul>li:hover{
            background-color:#555555;
            vertical-align: middle;
        }
        .category-detail ul>li>a{
            text-decoration:none;
            color:white;
        }
    </style>


    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(doReady);
        function doReady() {
            $('.account-title').mouseenter(function(){
                $(".header-nav-right").find('.bag-detail').hide();
                $(".bag-title").removeClass('changetitle');

                $(this).parent().find('.account-detail').show();
                $(this).addClass('changetitle');
            });
            $('.account').mouseleave(function(){
                $(this).find('.account-detail').hide();
                $(".account-title").removeClass('changetitle');
                $(this).find('.bag-detail').hide();
                $(".bag-title").removeClass('changetitle');
            });
            $('.bag-title').mouseenter(function(){
                $(".header-nav-right").find('.account-detail').hide();
                $(".account-title").removeClass('changetitle');
                $(this).parent().find('.bag-detail').show();
                $(this).addClass('changetitle');
            });

            $("#signin").click(function() {
                $(".blur").css('display','block');
                $(".signin").fadeIn();
            });
            $("#signin-cancel").click(function(){
                $(".signin").fadeOut();
                $(".blur").css('display','none');
            });
            $("#signup").click(function(){
                $(".blur").css('display','block');
                $(".signup").fadeIn();
            });
            $("#signup-cancel").click(function(){
                $(".signup").fadeOut();
                $(".blur").css('display','none');
            });
            $("#login").click(function () {
                $.ajax({
                    type: 'post',
                    url: 'signin.php',
                    dataType : 'text',
                    data : $('#form-signin').serialize(),
                    success: function( data ) {
                        if(data=='success')
                            location.reload();
                        else
                            document.getElementById("signin-error").innerHTML = data;
                    }
                });
            });
            $("#editprofile").click(function(){
                $(".edit").fadeIn();
                $(".blur").css('display','block');
            });
            $("#edit-cancel").click(function(){
                $(".edit").fadeOut();
                $(".blur").css('display','none');

            });


            $flag=false;
            $("#headphones").mouseenter(function(){
                if($flag==false){
                    $flag = true;
                }
                else{
                    $("#headphones-detail").fadeOut();
                    $("#speakers-detail").fadeOut();
                    $("#hometheater-detail").fadeOut();
                    $("#wavesystem-detail").fadeOut();
                }
                $("#headphones-detail").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#speakers").mouseenter(function(){
                if($flag==false){
                    $flag = true;
                }
                else{
                    $("#headphones-detail").fadeOut();
                    $("#speakers-detail").fadeOut();
                    $("#hometheater-detail").fadeOut();
                    $("#wavesystem-detail").fadeOut();
                }
                $("#speakers-detail").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#hometheater").mouseenter(function(){
                if($flag==false){
                    $flag = true;
                }
                else{
                    $("#headphones-detail").fadeOut();
                    $("#speakers-detail").fadeOut();
                    $("#hometheater-detail").fadeOut();
                    $("#wavesystem-detail").fadeOut();
                }
                $("#hometheater-detail").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#wavesystem").mouseenter(function(){
                if($flag==false){
                    $flag = true;
                }
                else{
                    $("#headphones-detail").fadeOut();
                    $("#speakers-detail").fadeOut();
                    $("#hometheater-detail").fadeOut();
                    $("#wavesystem-detail").fadeOut();
                }
                $("#wavesystem-detail").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });

            $(".category-nav").mouseleave(function(){
                $("#headphones-detail").fadeOut();
                $("#speakers-detail").fadeOut();
                $("#hometheater-detail").fadeOut();
                $("#wavesystem-detail").fadeOut();
                $(".category-nav").css('z-index','0');
                $(".blur").css('display','none');
                $("#specialsale1-item").fadeOut();
                $("#specialsale2-item").fadeOut();
                $("#specialsale3-item").fadeOut();
                $("#specialsale4-item").fadeOut();

                $flag = false;
            });
            $("#specialsale1").mouseenter(function(){
                $("#specialsale1-item").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#specialsale2").mouseenter(function(){
                $("#specialsale2-item").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#specialsale3").mouseenter(function(){
                $("#specialsale3-item").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
            $("#specialsale4").mouseenter(function(){
                $("#specialsale4-item").fadeIn();
                $(".category-nav").css('z-index','35');
                $(".blur").css('display','block');
            });
        }

        function validation(){
            return true;
        }
    </script>
</head>

<body class="body">
<header class="header">
    <div class="line-holder">
        <div class="line leftline"></div>
        <div class="line rightline"></div>
    </div>
    <div class="userinfo">
    <?php
    echo 'Welcome';
    if(isset($_GET['timeout'])&&strlen($_SESSION['username'])==0){
        echo "<span style='color:red'>Your session was timeout!</span>";
    }

    if(strlen($_SESSION['username'])!=0){
        echo "<div class='username'> ";
        echo ": ".$_SESSION['username'];
        echo "</div>";
        echo "<div id='logout'>";
        echo '<a style="color:white" href="logout.php">log out</a>';
        echo "</div>";
    }
    ?>
    </div>
    <div class="header-nav">
        <div class="logo"><img style="width:300px;height:40px" src="img/logo.png"/></div>
        <div class="header-nav-right">
            <ul class="account">
                <li>
                    <div class="account-title" style="cursor:pointer">
                        <?php
                            if(strlen($_SESSION['username'])!=0)
                                echo $_SESSION['username'];
                            else
                                echo "SIGN IN";
                        ?>
                    </div>
                    <div class="account-detail" style="display:none">
                        <ul style="text-align: left;margin-top:0px;padding:0px">
                                <?php
                                    if(strlen($_SESSION['username'])!=0){
                                        echo '<li id="editprofile">Edit Profile</li>';
                                        echo '<li onclick="javascript:trackorder();" id="myorder">Track my order</li></li>';
                                    }
                                    else{
                                        echo '<li id="signin">';
                                        echo "Sign In";
                                        echo '</li>';
                                        echo '<li id="signup">Become a member</li>';
                                    }
                                ?>
                        </ul>
                    </div>
                </li>
                &nbsp
                <li>
                    <div style="cursor:pointer" class="bag-title">BAG</div>
                    <div class="bag-detail" style="display:none;overflow: scroll">
                            <h2 style="border-bottom:solid 1px grey;">Shopping Bag</h2>
                        <div id="bag-items" style="overflow:scroll">
                        <?php
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
                        ?>
                        </div>
                        <input class="button" id="placeorder" type="button" onclick="javascript:placeOrder();" value="Place Order"/>
                        <input class="button" id="clearcart" onclick="javascript:clearCart();" type="button" value="Clear Cart"/>
                    </div>
                </li>
                <li style="display:block;margin-top:1rem;margin-left:2rem;">
                    <form method="POST" action="javascript:alert('success');">
                        <input type="search" name="search" placeholder="search" maxlength="50"/>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="category-nav">
        <ul id="category-title">
            <li>
                <a id="headphones">HEADPHONES</a>
            </li>
            &nbsp
            <li>
                <a id="speakers">SPEAKERS</a>
            </li>
            &nbsp
            <li>
                <a id="hometheater">HOME THEATER</a>
            </li>
            &nbsp
            <li>
                <a id="wavesystem">WAVE SYSTEM</a>
            </li>
        </ul>
        <ul>
            <li style="display:inline-block">
            <div id="headphones-detail" class="category-detail" style="position:absolute;left:0px;top:33px;display:none">
                <?php
                $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
                or die("unable to connect mysql");
                $select = mysql_select_db('users', $con)
                or die('Could not select users');
                $sql = "select * from product where productcategoryID=1";
                $res = mysql_query($sql)
                or die('Invalid query' . $sql);
                echo "<ul style='padding:0px;list-style: none;'>";
                while($row=mysql_fetch_array($res)){
                    $sql_special = "select * from specialsale where productID='".$row['productID']."'";
                    $result = mysql_query($sql_special)
                    or die('Invalid query' . $sql_special);
                    if((mysql_fetch_array($result)))
                        echo "<ul id='specialsale1'>
                                <li>Special Sale</li>
                                <div style='display:none' id='specialsale1-item'><a style='font-size:1em' href='javascript:shopPage(".$row['productID'].")'><span style='color:red'>#</span>".$row['productname']."</a></div>
                                </ul>";
                    else
                        echo "<li><a href='javascript:shopPage(".$row['productID'].")'>".$row['productname']."</a></li>";
                }
                echo "</ul>";
                ?>
            </div>
            </li>
            <li style="display:inline-block">
                <div id="speakers-detail" class="category-detail" style="display:none;position:absolute;left:130px;top:33px;">
                    <?php
                    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
                    or die("unable to connect mysql");
                    $select = mysql_select_db('users', $con)
                    or die('Could not select users');
                    $sql = "select * from product where productcategoryID=2";
                    $res = mysql_query($sql)
                    or die('Invalid query' . $sql);
                    echo "<ul style='padding:0px;list-style: none'>";
                    while($row=mysql_fetch_array($res)){
                        $sql_special = "select * from specialsale where productID='".$row['productID']."'";
                        $result = mysql_query($sql_special)
                        or die('Invalid query' . $sql_special);
                        if((mysql_fetch_array($result)))
                            echo "<ul id='specialsale2'>
                                <li>Special Sale</li>
                                <div style='display:none' id='specialsale2-item'><a style='font-size:1em' href='javascript:shopPage(".$row['productID'].")'><span style='color:red'>#</span>".$row['productname']."</a></div>
                                </ul>";
                        else
                            echo "<li><a href='javascript:shopPage(".$row['productID'].")'>".$row['productname']."</a></li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </li>
            <li style="display:inline-block">
                <div id="hometheater-detail" class="category-detail" style="display:none;position:absolute;left:234px;top:33px;">
                    <?php
                    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
                    or die("unable to connect mysql");
                    $select = mysql_select_db('users', $con)
                    or die('Could not select users');
                    $sql = "select * from product where productcategoryID=3";
                    $res = mysql_query($sql)
                    or die('Invalid query' . $sql);
                    echo "<ul style='padding:0px;list-style: none'>";
                    while($row=mysql_fetch_array($res)){
                        $sql_special = "select * from specialsale where productID='".$row['productID']."'";
                        $result = mysql_query($sql_special)
                        or die('Invalid query' . $sql_special);
                        if((mysql_fetch_array($result)))
                            echo "<ul id='specialsale3'>
                                <li>Special Sale</li>
                                <div style='display:none' id='specialsale3-item'><a style='font-size:1em' href='javascript:shopPage(".$row['productID'].")'><span style='color:red'>#</span>".$row['productname']."</a></div>
                                </ul>";
                        else
                            echo "<li><a href='javascript:shopPage(".$row['productID'].")'>".$row['productname']."</a></li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </li>
            <li style="display:inline-block">
                <div id="wavesystem-detail" class="category-detail" style="display:none;position:absolute;left:380px;top:33px;">
                    <?php
                    $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
                    or die("unable to connect mysql");
                    $select = mysql_select_db('users', $con)
                    or die('Could not select users');
                    $sql = "select * from product where productcategoryID=4";
                    $res = mysql_query($sql)
                    or die('Invalid query' . $sql);
                    echo "<ul style='padding:0px;list-style: none'>";
                    while($row=mysql_fetch_array($res)){
                        $sql_special = "select * from specialsale where productID='".$row['productID']."'";
                        $result = mysql_query($sql_special)
                        or die('Invalid query' . $sql_special);
                        if((mysql_fetch_array($result)))
                            echo "<ul id='specialsale4'>
                                <li>Special Sale</li>
                                <div style='display:none' id='specialsale4-item'><a style='font-size:1em' href='javascript:shopPage(".$row['productID'].")'><span style='color:red'>#</span>".$row['productname']."</a></div>
                                </ul>";
                        else
                            echo "<li><a href='javascript:shopPage(".$row['productID'].")'>".$row['productname']."</a></li>";
                    }
                    echo "</ul>";
                    ?>
                </div>
            </li>
        </ul>
    </div>
</header>

<?php
$sql = "select * from specialsale";
$con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
or die("unable to connect mysql");
$select = mysql_select_db('users', $con)
or die('Could not select users');
$res = mysql_query($sql)
or die('Invalid query');
$count = 0;
$specialrow = mysql_fetch_array($res);
$sql = "select * from product where productID=" . $specialrow['productID'];
$result = mysql_query($sql)
or die("Invalid query for product");
$row = mysql_fetch_array($result);
?>
<span id="special-title" style='color:white;font-family: Comic Sans MS; text-transform: uppercase;font-size:300%;position:absolute;left:43%;'>today's special</span>
<div id="play" class="play">
    <a href="javascript:" id="next">>
        <div class="nextImg"><img width="80" height="54" src=""/></div>
    </a>
    <a href="javascript:" id="prev"><
        <div class="prevImg"><img width="80" height="54" src=""/></div>
    </a>

    <?php
    echo '<ul class="ps_nav" style="padding-left: 0px">';
    echo '<li>';
    echo '<a href="javascript:shopPage('.$row['productID'].');">';
    echo '<img src="' . $row['productimg'] . '"/></a></li>';
    $count++;
    while ($specialrow = mysql_fetch_array($res)) {
        $count++;
        $sql = "select * from product where productID=" . $specialrow['productID'];
        $result = mysql_query($sql)
        or die("Invalid query for product");
        $row = mysql_fetch_array($result);
        echo '<li>';
        echo '<a href="javascript:shopPage('.$row['productID'].');">';
        echo '<img src="' . $row['productimg'] . '"/></a></li>';
    }
    echo '</ul>';

    echo '<ol>';
    echo '</ol>';
    ?>
</div>

<div id="shoppage" style="display: none;width:100%;height:90%;overflow:scroll;position:absolute;top:15%;left:0px;">
</div>

<script type="text/javascript">
    $(function () {
        var oDiv = $("#play");
        var count = $("#play ul li").length;
        var countwidth = $("#play ul li").width();
        var oUl = $("#play ul").css("width", count * countwidth);
        var now = 0;
        var next = $("#next");
        var prev = $("#prev");
        for (var i = 0; i < count; i++) {
            $("#play ol").append("<li>" + Number(i + 1) + "</li>");
            $("#play ol li:first").addClass("active");
        }
        var nI = $("#play ul li:nth-child(2)").find("img").attr("src");
        $(".nextImg img").attr("src", nI);
        var pI = $("#play ul li:last-child").find("img").attr("src");
        $(".prevImg img").attr("src", pI);
        var aBtn = $("#play ol li");
        aBtn.each(function (index) {
            $(this).click(function () {
                clearInterval(timer);
                tab(index);
                nextImg();
                prevImg();
                timer = setInterval(autoRun, 2000);
            });
        });
        function tab(index) {
            now = index;
            aBtn.removeClass("active");
            aBtn.eq(index).addClass("active");
            oUl.stop(true, false).animate({"left": -countwidth * now}, 400);
        }

        function nextImg() {
            var d = $("#play ul li").find("img").eq(now + 1).attr("src");
            var nI = $("#play ul li:nth-child(1)").find("img").attr("src");
            $(".nextImg").find("img").attr("src", d);
            if (now == count - 1) {
                $(".nextImg").find("img").attr("src", nI);
            }
        }

        function prevImg() {
            var f = $("#play ul li").find("img").eq(now - 1).attr("src");
            $(".prevImg").find("img").attr("src", f);
        }

        next.click(function () {
            clearInterval(timer);
            now++;
            if (now == count) {
                now = 0;
            }
            tab(now);
            nextImg();
            prevImg();
            timer = setInterval(autoRun, 2000);
        });
        prev.click(function () {
            clearInterval(timer);
            now--;
            if (now == -1) {
                now = count - 1;
            }
            tab(now);
            nextImg();
            prevImg();
            timer = setInterval(autoRun, 2000);
        });
        function autoRun() {
            now++;
            if (now == count) {
                now = 0;
            }
            tab(now);
            nextImg();
            prevImg();
        };
        var timer = setInterval(autoRun, 2000);
    });
    function shopPage(productID){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("shoppage").innerHTML = xmlhttp.responseText;
                document.getElementById("play").style.display = 'none';
                document.getElementById('shoppage').style.display = 'block';
                document.getElementById('special-title').style.display = "none";
            }
        }
        xmlhttp.open("GET", "shoppage.php?productID="+productID, true);
        xmlhttp.send();
    }
    function addToCart(productID) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bag-items").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "addtocart.php?productID="+productID, true);
        xmlhttp.send();
    }
    function clearCart(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bag-items").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "clearcart.php", true);
        xmlhttp.send();
    }
    function removeCart(productID){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("bag-items").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "removecart.php?productID="+productID, true);
        xmlhttp.send();
    }
    function checkout(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if(xmlhttp.responseText=='false'){
                    $(".blur").css('display','block');
                    $(".placeorder").fadeOut();
                    $(".signin").fadeIn();
                }
                else{
                    $(".placeorder").fadeOut();
                    $(".blur").css('display','none');
                }
            }
        }
        xmlhttp.open("GET", "checkout.php", true);
        xmlhttp.send();
    }
    function trackorder(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("trackorder").innerHTML=xmlhttp.responseText;
                $(".blur").css('display','block');
                $("#trackorder").fadeIn();
            }
        }
        xmlhttp.open("GET", "trackorder.php", true);
        xmlhttp.send();
    }
    function closeTrack(){
        $("#trackorder").fadeOut();
        $(".blur").css('display','none');
    }
    function showOrderDetail(orderID){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("orderdetail").innerHTML=xmlhttp.responseText;
                $(".blur").css('display','block');
                $("#orderdetail").fadeIn();
            }
        }
        xmlhttp.open("GET", "orderdetail.php?orderID="+orderID, true);
        xmlhttp.send();
    }
    function closeOrderDetail(){
        $("#orderdetail").fadeOut();
        $(".blur").css('display','none');
    }
    function backToTrackorder(){
        closeOrderDetail();
        trackorder();
    }
    function placeOrder(){
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("showplaceorder").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "placeorder.php", true);
        xmlhttp.send();
        $(".placeorder").fadeIn();
        $(".blur").css('display','block');
    }
    function cancelPlaceOrder(){
        $(".placeorder").fadeOut();
        $(".blur").css('display','none');
    }
    function checkform(){
        var reg = new RegExp("^[A-Za-z]+$");
        var flag = true;
        document.getElementById("lable-username").style.color = "black";
        document.getElementById("lable-firstname").style.color = "black";
        document.getElementById("lable-lastname").style.color = "black";
        document.getElementById("lable-password").style.color = "black";
        document.getElementById("lable-repassword").style.color = "black";
        document.getElementById("lable-address").style.color = "black";
        document.getElementById("lable-zipcode").style.color = "black";
        document.getElementById("lable-cardnumber").style.color = "black";
        document.getElementById("lable-expiredate").style.color = "black";


        if(reg.test(document.getElementById("username").value)==false||
            document.getElementById("username").value.length==0){
            document.getElementById("lable-username").style.color = "red";
            flag = false;
        }
        if(reg.test(document.getElementById("firstname").value)==false||
            document.getElementById("firstname").value.length==0){
            document.getElementById("lable-firstname").style.color = "red";
            flag = false;
        }
        if(reg.test(document.getElementById("lastname").value)==false
            ||document.getElementById("lastname").value.length==0){
            document.getElementById("lable-lastname").style.color = "red";
            flag = false;
        }

        reg = new RegExp("^[0-9]*")
        if(reg.test(document.getElementById("zipcode").value)==false||
            document.getElementById("zipcode").value.length==0){
            document.getElementById("lable-zipcode").style.color = "red";
            flag = false;
        }
        if(reg.test(document.getElementById("cardnumber").value)==false||
            document.getElementById("cardnumber").value.length==0){
            document.getElementById("lable-cardnumber").style.color = "red";
            flag = false;
        }

        if(document.getElementById("password").value!=document.getElementById("re-password").value
            ||document.getElementById("password").value.length==0||
            document.getElementById("re-password").value.length==0){
            document.getElementById("lable-password").style.color = "red";
            document.getElementById("lable-repassword").style.color = "red";
            flag = false;
        }
        if(document.getElementById("address").value.length==0){
            document.getElementById("lable-address").style.color = "red";
            flag = false;
        }
        if(document.getElementById("expiredate").value.length==0){
            document.getElementById("lable-expiredate").style.color = "red";
            flag = false;
        }
        return flag;
    }

</script>


<div class="signin">
<h2>Members</h2>
<form id="form-signin">
    <ul style="list-style: none">
        <li>
            <p><label class="label">account name</label></p>
            <input class="input" type="text" name="username"/>
        </li>
        <li>
            <p><label class="label">password</label></p>
            <input class="input" type="password" name="password"/>
        </li>
        <li>
            <p id="signin-error" style="font-size:13px;color:red"></p>
            <p><label style="font-size:13px">I agree to the BOSE club term.</label></p>
            <input class='button' type="button" id="login" value="sign in"/>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input class='button' id="signin-cancel" type="button" value="cancel"/>
        </li>
    </ul>
</form>
</div>
<div class="signup">
    <form id="form-signup" action="signup.php" onsubmit="return checkform();" method="post">
    <table frame="void">
        <tr>
        <td style="vertical-align: top; padding-left:0px;padding-right:20px; border-right:solid 1px grey;">
        <h2>become a member</h2>
        <ul style="padding-left:0px;list-style:none;">
            <li>
                <p>
                    <label id="lable-username">USER NAME</label><br/>
                    <input class="input" type="text" id="username" name="username" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-firstname" >FIRST NAME</label><br/>
                    <input class="input" type="text" id="firstname" name="firstname" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-lastname" >LAST NAME</label><br/>
                    <input class="input" type="text" id="lastname" name="lastname" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-password" >PASSWORD</label><br/>
                    <input class="input" type="password" id="password" name="password" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-repassword" >RE-ENTER PASSWORD</label><br/>
                    <input class="input" type="password" id="re-password" name="re-password" required/>
                </p>
            </li>
        </ul>
        </td>

        <td style="vertical-align: top;padding-left:20px">
            <ul style="list-style:none;padding-left:0px">
            <h2>mail info</h2>
            <li>
                <p>
                    <label id="lable-address" >ADDRESS</label><br/>
                    <input class="input" type="text" id="address" name="address" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-zipcode" >ZIP CODE</label><br/>
                    <input class="input" type="text" id="zipcode" name="zipcode" required/>
                </p>
            </li>
            <h2>Pay Method</h2>
            <li>
                <p>
                    <label id="lable-cardnumber" >Credit Card Number</label><br/>
                    <input class="input" type="text" id="cardnumber" name="cardnumber" required/>
                </p>
            </li>
            <li>
                <p>
                    <label id="lable-expiredate" >Expire Date</label><br/>
                    <input class="input" type="date" id="expiredate" name="expiredate" required/>
                </p>
            </li>
        </ul>
        </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;padding-top:20px;">
                <input class='button' type="submit" id="submit-signup" value="SIGN UP"/>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input class='button' id="signup-cancel" type="button" value="CANCEL"/></td>
        </tr>
    </table>
    </form>
</div>
<div id="showplaceorder" class="placeorder" style="font-size:250%;overflow: scroll">
<?php
    $totalprice = 0;

    echo "<h2>Your Order</h2>";
    echo" <table border='1'><tr><td>Product</td><td>Price</td><td>Quantity</td></tr>";
    foreach($_SESSION['cart'] as $key => $value){
        $price = 0;
        $sql = "select * from product where productID=$key";
        $con = mysql_connect('cs-server.usc.edu:8317', 'root', '')
        or die("unable to connect mysql");
        $select = mysql_select_db('users', $con)
        or die('Could not select users');
        $res = mysql_query($sql)
        or die('Invalid query');
        $row = mysql_fetch_array($res);

        echo '<tr>';
        echo '<td>'.$row['productname'].'</td>';

        $sql = "select * from specialsale where productID=$key";
        $res = mysql_query($sql)
        or die('Invalid query');
        $row_special = mysql_fetch_array($res);
        if($row_special){
            $price = $row_special['discount']*$row['pricerange']/100;
            echo '<td>
                    <span style="text-decoration: line-through">$'.$row['pricerange'].'</span>
                    <span style="color:red">  $'.$price.'</span>';
        }
        else{
            $price = $row['pricerange'];
            echo '<td>$'.$price.'</td>';
        }

        echo '<td>'.$value.'</td>';
        echo '</tr>';
        $totalprice += $price*$value;
    }
    echo "<tr ><td colspan='3'>TOTAL PRICE: $ $totalprice</td></tr>";
    echo '</table>';
    echo '<input class="button" type="button" onclick="javascirpt:checkout();" value="Check Out"/>';
echo '<input class="button" id="placeorder-cancel" onclick="javascript:cancelPlaceOrder();" type="button" value="CANCEL"/>';
?>
</div>

<div id="trackorder" style="font-size:250%;overflow: scroll">
</div>
<div id="orderdetail" style="font-size:250%;overflow: scroll">
</div>

<div class="edit">
    <?php require "editprofile.html";?>
</div>
<div class="blur"></div>
</body>

</html>