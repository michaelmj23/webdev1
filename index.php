<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to Dashboard</h1>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lost and Found System</title>
<link rel="stylesheet" href="css/style2.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php' ?>
<section id="home" class="home-section">
    <h2>Welcome to the Lost and Found System</h2>
    <div id="introduction" class="intro">
        <div class="intro-content">
            <p>Welcome to the University of San Carlos Talamban Campus Lost and Found System! We understand that losing or misplacing items can be a stressful experience, which is why we've created this platform to help reunite lost items with their owners in a simple and efficient manner.

            Our system is designed exclusively for use within the University of San Carlos Talamban Campus community. Whether you're a student, faculty member, or staff, this platform is here to assist you in finding your lost items or returning found items to their rightful owners.

            Using our system is easy. If you've lost an item, simply navigate to the Lost Items section, where you can browse through a list of items that have been found on campus. Each item is accompanied by a description and, if available, a photo to help you identify it. If you see an item that belongs to you, click on it to view more details and contact information to claim it.

            On the other hand, if you've found an item on campus, we encourage you to post it in the Found Items section. By providing a description and photo of the item, you'll be helping its owner locate it more easily. You can also mark the item as available or unavailable to indicate its status.

            Our goal is to make the process of reporting and recovering lost items as seamless as possible. We believe that by coming together as a community, we can help each other in times of need and ensure that lost items are returned to their rightful owners.

            Thank you for using the University of San Carlos Talamban Campus Lost and Found System. Together, we can make a difference!</p>
        </div>
        <div class="intro-image">
            <img src="images/Background_Image.png" alt="Introduction Image">
        </div>
    </div>
</section>
</body>
</html>