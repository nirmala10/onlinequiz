<?php
session_start();
include('header.php');
 if(!empty($_SESSION['username'])){
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$query="SELECT * FROM results";
$result=mysqli_query($con,$query);


   
                  echo '<table class= maintable><tr><th class=cell>';
                 echo 'username</th><th class= cell>';
                 echo 'Categoryname</th><th class= cell>';
                 echo 'quizname</th><th class= cell>';
                 echo 'Attempt count</th><th class= cell>';
                 echo 'Marks obtained</th><th class= cell>';
                 echo 'Out of</th></tr>';
                 
                 while($row=mysqli_fetch_array($result))
                 {   echo '<tr><td class= cell>';
                 echo $row['username'];
                 echo '</td><td class= cell>';
                     echo $row['categoryname'];
                     echo '</td><td class= cell>';
                     echo $row['quizname'];
                     echo '</td><td class= cell>';
                   
                   
                     echo $row['attempt_count'];
                     echo '</td><td class= cell>';
                     
                     echo $row['marks_obtained'];
                     echo '</td><td class= cell>';
                     echo $row['outof'];
                     echo '</td></tr>';
                    
     
                 }
                 echo '</table>';
    
    
    






?>
<html>
    
    <head>
        <style>
            .maintable
            
            {
                margin:100px ;
               
                
              border:solid goldenrod 1px;
            }
            .cell
            {   
                margin:20px;
                border:solid goldenrod 1px;
            }
        </style>
    </head>
    
    
</html>

<?php

include('footer.php');
 }
 else 
     
 {
     header('Location:login.php?loginfirst');
 }
?>

