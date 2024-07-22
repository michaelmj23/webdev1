<?php 
session_start();
include 'config/database.php';
include 'config/session.php';

if($_SESSION["uid"] !=1 )
   header("Location: index.php");
    ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Super Index</title>
	<link rel="stylesheet" href="css/admin_style.css">
    <link rel="icon" href="img/orig_logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style2.css">
	<style>
        body {
            background-image: url('https://scontent.fceb1-4.fna.fbcdn.net/v/t39.30808-6/350314462_623519289806120_6812076341586289764_n.jpg?stp=cp6_dst-jpg&_nc_cat=107&ccb=1-7&_nc_sid=86c6b0&_nc_eui2=AeFIA0uOsrtmVEZN-8FqVu5vNDvZPRZ15Qk0O9k9FnXlCR96zAuOunC_oN__HfD6RjQI8e7jYPlkOmVVGJVpesa5&_nc_ohc=8WjPI33muFwQ7kNvgFW0Bps&_nc_ht=scontent.fceb1-4.fna&oh=00_AYBgwqlu-W31QjX56jdLuw-3PTXty9I8wtkQpJmSMnBfUQ&oe=669474DF');
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
        }

        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: -1;
        }

        .container {
            width: 80%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
         margin-top: 250px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .btns {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            color: black;
            background-color: #efefef;
            border: 1px solid #7d7d7d;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btns:hover {
            background-color: #e04350;
        }

        .btns:active {
            background-color: #c0392b;
        }

        .btns:focus {
            outline: none;
        }

        .product-image img {
            width: 100px;
            height: 100px;
        }

    </style>
</head>
<body>
	<?php include 'snavbar.php' ?>
	<h1>You are powerful!</h1>
</body>
</html>