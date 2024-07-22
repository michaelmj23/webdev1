<?php
   session_start();
   if (!isset($_SESSION["user"])) {
      header("Location: login.php");
   }
   include 'config/session.php';
   
   
   include 'config/database.php';

   $name = $description = $image = $location = '';
   $errors = array('name' => '', 'description' => '', 'image' => '', 'location' => '', 'contact' => '');

   if(isset($_POST['submit'])){
      
      // check name
      if(empty($_POST['name'])){
         $errors['name'] = 'Item name is required';
      } else{
         $name = $_POST['name'];         
      }

      // check price
      if(empty($_POST['description'])){
         $errors['description'] = 'Please provide item description';
      } else{
         $description = $_POST['description'];
      }

      // check pic
      if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
         $image = $_FILES['image'];
         $allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
         $detected_type = exif_imagetype($image['tmp_name']);
         $error = !in_array($detected_type, $allowed_types);
         
         if($error){
            $errors['image'] = 'Invalid image type. Only JPG, PNG, and GIF are allowed.';
         }
      } else {
         $errors['image'] = 'Item image is required.';
      }

      if(empty($_POST['location'])){
         $errors['location'] = 'Please provide item description';
      } else{
         $location = $_POST['location'];
      }

      if(empty($_POST['contact'])){
         $errors['contact'] = 'Enter your contact number';
      } else{
         $contact = $_POST['contact'];
         if(!is_numeric($contact) || strlen($contact) < 11 || strlen($contact) > 12){
            $errors['contact'] = 'Please enter valid contact number';
         }
      }

      $image = $_FILES['image']['name'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'uploads/'.$image;

      if(array_filter($errors)){
         // echo 'errors in form';
      } else {
         // escape sql chars
         $name = mysqli_real_escape_string($conn, $_POST['name']);
         $description = mysqli_real_escape_string($conn, $_POST['description']);
         $location = mysqli_real_escape_string($conn, $_POST['location']);
         $contact = mysqli_real_escape_string($conn, $_POST['contact']);
         
         $sql = "INSERT INTO item(name, description, image, location, contact, userid) VALUES('$name', '$description', '$image', '$location', '$contact', '$uid')";

         if(mysqli_query($conn, $sql)){
            move_uploaded_file($image_tmp_name, $image_folder);
            $display_message = "<div class='alert alert-success'>Item added successfully</div>";
         } else {
            $display_message = "<div class='alert alert-danger'>Error adding product</div>";
         }
      }
   }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Report Item</title>
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

<?php include("navbar.php");?>

<section class="container">
   <?php 
      if(isset($display_message)){
         echo "<div class='display_message'>
            <span>$display_message</span>
            <i class='fas fa-times' onclick='this.parentElement.style.display=`none`';></i>
         </div>";
      }
   ?>
   <h4>List Item</h4>
   <form action="report.php" method="POST" enctype="multipart/form-data">
      <label>Item Name</label>
      <input type="text" name="name">
      <div style="color:red"><?php echo $errors['name']; ?></div>

      <label>Item Description</label>
      <input type="text" name="description">
      <div style="color:red"><?php echo $errors['description']; ?></div>

      <label>Upload Image</label>
      
      <input type="file" id="image" name="image" required accept="image/png, image/jpg, image/jpeg" onchange="readURL(this);" >
      <img src="#" id="category-img-tag" width="200px" />
      <div style="color:red"><?php echo $errors['image']; ?></div>       
                  

      <label>Location found</label>
      <input type="text" name="location">
      <div style="color:red"><?php echo $errors['location']; ?></div>

      <label>Contact Number</label>
      <input type="text" name="contact" value="<?php echo $contact ?>">
      <div style="color:red"><?php echo $errors['contact']; ?></div>

      <div>
         <input type="submit" name="submit" value="Submit">
      </div>
   </form>
</section>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#category-img-tag').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image").change(function(){
        readURL(this);
    });
</script>
</body>
</html>
