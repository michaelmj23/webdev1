<?php    
session_start();
if($_SESSION["uid"] !=1 )
   header("Location: index.php");

include 'config/database.php';


if (isset($_GET['id'])){ 
  
        // Store the value from get to a  
        // local variable "course_id" 
        $id=$_GET['id']; 
  
        // SQL query that sets the status 
        // to 1 to indicate activation. 
        $sql="UPDATE `item` SET  
             `isreturned`=1 WHERE id=$id"; 
  
        // Execute the query 
        mysqli_query($conn,$sql); 
    } 

        header('location: superitems.php');
?>