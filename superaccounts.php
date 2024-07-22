<?php
session_start();
include 'config/database.php';
include 'config/session.php';

if($_SESSION["uid"] !=1 )
   header("Location: index.php");


    $delete_message = ""; // Initialize deletion message

if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
    $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id_to_delete);
    
    if(mysqli_stmt_execute($stmt)){
        $delete_message = "<div class='alert alert-success'>Account deleted successfully.</div>";
    } else {
        $delete_message = "<div class='alert alert-success'>Error deleting account.</div>";
    }
    
    // Refresh the page after deletion
    echo '<meta http-equiv="refresh" content="0">';
    exit(); // Stop further script execution after refresh
}

    $sql = 'SELECT * FROM users WHERE id > 1';
    $result = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 0;

// Sorting logic based on the selected option
    if ($sortOption == 1) {
    // Sort by Item Name
    usort($items, function($a, $b) {
        return $a['full_name'] <=> $b['full_name'];
    });
    }   elseif ($sortOption == 2) {
    // Sort by Item Name
    usort($items, function($a, $b) {
        return $a['email'] <=> $b['email'];
    });
    }   elseif ($sortOption == 3) {
    // Sort by Item Name
    usort($items, function($a, $b) {
        return $a['id'] <=> $b['id'];
    });
    } elseif ($sortOption == 4) {
    // Sort by Date Reported
    usort($items, function($a, $b) {
        return $a['isactive'] <=> $b['isactive'];
    });
    
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show All Items</title>
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
    <script>
        function sortItems() {
            var sortOption = document.getElementById("sortSelect").value;
            // Perform an AJAX call to handle sorting without reloading the page
            // You can call a PHP script to fetch and display the sorted items dynamically
            // Here we'll just reload the page with the selected sorting option
            window.location.href = "superaccounts.php?sort=" + sortOption;
        }
    </script>
</head>
<body>
    

    <?php include("snavbar.php");?>
    
    <?php if($items): ?>        
        <div class="container">            
    <h1>All Accounts</h1>
    <form action="superaccounts.php" method="POST">
            <div>
                <label for="sortSelect">Sort By:</label>
                 <select id="sortSelect" onchange="sortItems()">
                    <option value="0">--- Choose a category ---</option>
                    <option value="1" <?php echo ($sortOption == 1) ? 'selected' : ''; ?>>By Name</option>
                    <option value="2" <?php echo ($sortOption == 2) ? 'selected' : ''; ?>>By Email</option>
                    <option value="3" <?php echo ($sortOption == 3) ? 'selected' : ''; ?>>By ID</option>
                    <option value="4" <?php echo ($sortOption == 4) ? 'selected' : ''; ?>>By Status</option>
                </select>
                <input type="hidden" name="sort" value="<?php echo $sortOption; ?>">
            </div>
            </form>
            <section class="display_product">
                <table class="table">
                    <thead class="thead-dark">
                        <tr class="">
                            <th>uid</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>IsActive</th>
                            <th>Contact NO.</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                   <?php if($delete_message): ?>
            <div class="alert alert-success"><?php echo $delete_message; ?></div>
        <?php endif ?>
                    <tbody>
                    <?php foreach($items as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['id']) ?></td>
                            <td><?php echo htmlspecialchars($item['full_name']) ?></td>
                            <td><?php echo htmlspecialchars($item['email']) ?></td>
                            <td><?php echo ($item['isactive'] == 1) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'; ?></td>
                            <td><?php echo htmlspecialchars($item['contactn']) ?></td>
                            <form action="superaccounts.php" method="POST">
                            <td><input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($item['id']); ?>">
                                 <input type="submit" name="delete" value="Delete Account" class="btns" onclick="return window.confirm('Are you sure you want to delete this account?');"></td>
                            </form>  
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