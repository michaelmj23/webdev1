<?php 

session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}

include 'config/database.php';

if (isset($_GET['id'])){ 
  
        // Store the value from get to a  
        // local variable "course_id" 
        $id=$_GET['id']; 
  
        // SQL query that sets the status 
        // to 1 to indicate activation. 
        $sql="UPDATE `item` SET  
             `isreturned`=0 WHERE id=$id"; 
  
        // Execute the query 
        mysqli_query($conn,$sql); 
    }
    // Go back to course-page.php 
    header('location: myitems.php'); 
 ?>