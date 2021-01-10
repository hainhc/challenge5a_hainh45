<?php session_start(); ?>
<!doctype html>
<html>
    <head>

        <?php require_once("config.php"); ?>

        <?php
        if (!isset($_SESSION["loggedin"])) {
            auto_login();
        }
        ?>

        <title><?php echo $page_title; ?></title>
        <meta charset="utf-8"> 
        <meta name="keywords" content="<?php echo $page_keywords; ?>" />
        <meta name="description" content="<?php echo $page_description; ?>" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />	
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.js"></script>
        <link rel="stylesheet" 	href="css/ui-lightness/jquery-ui-1.10.2.custom.css" />
        <!-- 	<link rel="stylesheet" 	href="css/jmetro/jquery-ui-1.10.2.custom.css" /> -->
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                border-style: hidden;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>

    </head>
    <body>
        <div id="pageWrapper">
            <div id="header">
                <img id="logo" src="<?php echo IMAGES_DIR; ?>/logo.png" />
                <h1 id="siteTitle"> LAB01: LAP TRINH WEB CO BAN </h1>	
            </div> <!-- End of header -->

            <div id="nav"> 
                <div  id="menu" > 
                    <a href="index.php">Trang chủ</a> |  
                    <a href="ds_sinhvien.php">Sinh viên</a>	|
                    <a href="ds_giaovien.php">Giáo viên</a>		 
                </div>		 
                <div  id="login" > 
                    <?php
                    // lấy cookie đăng nhập tự động

                    if (isset($_SESSION["loggedin"])) {
                        echo "Xin chào " . $_SESSION["HoTen"];
                        echo " | <a href='login.php?logut' id='aLogout'>Thoát</a>";
                    } else {

                        echo "<a href='login.php'>Đăng nhập</a>";
                    }
                    ?>
                </div>
            </div> <!-- End of Navigation menu --> 

            <div id="contentWrapper" > 
                <div id="leftSide" > 
                    <div class="group-box" id="danhmuc"> 
                        <div class="title">Cá nhân</div>  
                        <div class="group-box-content">
                            <ul>
                                <li> <a href="info.php"> Thông tin cá nhân</a> </li>
                                <li> <a href="inbox.php"> Hộp thư đến</a> </li>
                                <li> <a href="sent.php"> Thư đã gửi</a> </li>
                            </ul>						
                        </div>						
                    </div>
                    <div class="group-box"> 
                        <div class="title">Menu</div> 
                        <div class="group-box-content">
                            <ul>							
                                <li> <a href="baitap.php">Bài tập</a> </li>
                                <li> <a href="challenge.php">Giải đố</a> </li>
                            </ul>						
                        </div>						
                    </div>
                </div> <!-- End of Left Side -->
                <div id="mainContent">