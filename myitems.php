<?php 
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}

    include 'config/database.php';
    include 'config/session.php';  


    $sql = "SELECT * FROM item WHERE userid = $uid";
    $result = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sortOption = isset($_GET['sort']) ? $_GET['sort'] : 0;

// Sorting logic based on the selected option
    if ($sortOption == 1) {
    // Sort by Item Name
    usort($items, function($a, $b) {
        return $a['name'] <=> $b['name'];
    });
    } elseif ($sortOption == 2) {
    // Sort by Date Reported
    usort($items, function($a, $b) {
        return strtotime($a['time_reported']) - strtotime($b['time_reported']);
    });
    } elseif ($sortOption == 3) {
    // Sort by Date Reported
    usort($items, function($a, $b) {
        return $a['isreturned'] <=> $b['isreturned'];
    });
    
}



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show My Items</title>
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

        .status-button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            color: #fff;
            border-radius: 5px;
            font-weight: bold;
        }

        .active {
            background-color: red;
        }

        .inactive {
            background-color: green;
        }


        .btn{ 
            background-color: red; 
            border: none; 
            color: white; 
            padding: 5px 5px; 
            text-align: center; 
            text-decoration: none; 
            display: inline-block; 
            font-size: 20px; 
            margin: 4px 2px; 
            cursor: pointer; 
            border-radius: 20px; 
        } 
        .green{ 
            background-color: #199319; 
        } 
        .red{ 
            background-color: red; 
        } 
        table,th{ 
            border-style : solid; 
            border-width : 1; 
            text-align :center; 
        } 
        td{ 
            text-align :center; 
        } 


    </style>
    <script>
        function sortItems() {
            var sortOption = document.getElementById("sortSelect").value;
            // Perform an AJAX call to handle sorting without reloading the page
            // You can call a PHP script to fetch and display the sorted items dynamically
            // Here we'll just reload the page with the selected sorting option
            window.location.href = "myitems.php?sort=" + sortOption;
        }
    </script>
</head>
<body>
    <?php include("navbar.php");?>   

    
    <?php if($items): ?>        
        <div class="container">
            <h1>My Reported Items</h1>
            <form action="myitems.php" method="POST">
            <div>
                <label for="sortSelect">Sort By:</label>
                 <select id="sortSelect" onchange="sortItems()">
                    <option value="0">--- Choose a category ---</option>
                    <option value="1" <?php echo ($sortOption == 1) ? 'selected' : ''; ?>>By Name</option>
                    <option value="2" <?php echo ($sortOption == 2) ? 'selected' : ''; ?>>By Date</option>
                    <option value="3" <?php echo ($sortOption == 3) ? 'selected' : ''; ?>>By Status</option>
                </select>
                <input type="hidden" name="sort" value="<?php echo $sortOption; ?>">
            </div>
            </form>
            <section class="display_product">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="">
                            <th>Item No.</th>
                            <th>Item Name</th>
                            <th>Item Image</th>
                            <th>Description</th>
                            <th>Location Found</th>
                            <th>Item Status</th>
                            <th>Contact Number</th>
                            <th>Date Reported</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($items as $item): ?>
                    <?php
// Simulating the retrieval of status from the database
     if($item['isreturned']=="1") {
     $status = "Item Returned"; // You can replace this with the actual status retrieved from the database
    } else {
    $status ="Item Not Returned";
 }
 $num = 1;
// Set the class based on the status
    $buttonClass = ($status === "active") ? "active" : "inactive";
    ?>
                        <tr>
                            <td><?php echo $num++ ?></td>
                            <td><?php echo htmlspecialchars($item['name']) ?></td>
                            <td class="product-image"><img src="uploads/<?php echo htmlspecialchars($item['image']) ?>" alt="Item Image"></td>
                            <td><?php echo htmlspecialchars($item['description']) ?></td>                            
                            <td><?php echo htmlspecialchars($item['location']) ?></td>
                            <td><?php echo ($item['isreturned'] == 1) ? '<span style="color:green">Returned</span>' : '<span style="color:red">Not Returned</span>'; ?></td>
                            <td><?php echo htmlspecialchars($item['contact']) ?></td>
                            <td><?php echo htmlspecialchars($item['time_reported']) ?></td>
                            <td>
                                   <!--  <button class="status-button
                                   <?php echo $buttonClass; ?>">
                                   <?php echo ucfirst($status); ?>
                                    </button> -->

                                    <?php 
                                    if($item['isreturned']=="1")  
                                     echo 
                                        "<a href=deactivate.php?id=".$item['id']." class='btn red'>Mark as not returned</a>"; 
                                    else 
                                     echo 
                                        "<a href=activate.php?id=".$item['id']." class='btn green'>Mark as returned</a>"; 
                                    ?>
                                    <a href="edit.php?id=<?php echo $item['id']; ?>" class="btns"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    <?php else: ?>
        <h1>No items listed.</h1>
    <?php endif ?>
</body>
</html>
