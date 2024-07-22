<!DOCTYPE html>
<html lang="en">
<head>
  <title>Navbar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<header>
    <div class="logo-container">
        <img id="website-logo" class="logo" src="images/Campuslogo.png" alt="Website Logo">
    </div>
</header>
<nav class="nav-menu">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Campus Reclaim</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="superindex.php">Home</a></li>
      <li><a href="superaccounts.php">All Accounts</a></li>
      <li><a href="superitems.php">All Items</a></li>
    </ul>
  </div>
  <div class="user-settings">
        <button>&#9881;</button>
        <div class="user-settings-menu">
            <a href="logout.php"><button id="logout-button">Logout</button></a>
        </div>
    </div>    
</nav>
<!-- <header>
    <div class="logo-container">
        <img id="website-logo" class="logo" src="images/Campuslogo.png" alt="Website Logo">
    </div>
</header>

<nav>
    <ul class="nav-menu">
        <li><a href="index.php" class="menu-item" onclick="setActive(this)">Home</a></li>
        <li><a href="#" class="menu-item" onclick="setActive(this)">Report a lost item</a></li>
        <li><a href="#" class="menu-item" onclick="setActive(this)">Claim Item</a></li>
        <li><a href="#" class="menu-item" onclick="setActive(this)">Show all Items</a></li>
    </ul>
    <div class="user-settings">
        <button>&#9881;</button>
        <div class="user-settings-menu">
            <a href="logout.php"><button id="logout-button">Logout</button></a>
        </div>
    </div>    
</nav> -->




</body>
</html>
