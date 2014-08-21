<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$username=$_SESSION['username'];
                echo 'Hello.....'. $username.'<br/>';
            
               $sql="SELECT id FROM users WHERE username='$username' ";
               $r=mysqli_query($con,$sql);
               $data=mysqli_fetch_array($r);
               $userid=$data['id'];


 
                 $query2="SELECT  *FROM results WHERE userid='$userid'";
            
                 $result=mysqli_query($con,$query2);
                 $num=mysqli_num_rows($result);
                 if($num==null)
                 {
                     echo 'you dint appear for any quiz previously<br/>';
                 exit;
                 }
                
                 echo '<b>Your previous score</b><br/>';
                 
                 $m=0;
                 echo '<table class=maintable><tr><th class=cell>';
                 echo 'Categoryname</th ><th class=cell>';
                 echo 'quizname</th><th class=cell>';
                 echo 'Attempt count</th><th class=cell>';
                 echo 'Marks obtained</th><th class=cell>';
                 echo 'Out of</th></tr>';
                 
                 while($row=mysqli_fetch_array($result))
                 {   echo '<tr><td class= cell>';
                     echo $row['categoryname'];
                     echo '</td><td class=cell>';
                     echo $row['quizname'];
                     echo '</td><td class= cell>';
                     $attempt[$m]=$row['attempt_count'];
                   
                     echo $row['attempt_count'];
                     echo '</td><td class= cell>';
                     $marks_obtained[$m]=$row['marks_obtained'];
                    
                     echo $row['marks_obtained'];
                     echo '</td><td class= cell>';
                     echo $row['outof'];
                     echo '</td></tr>';
                    
                 $m++;
                 }
                 echo '</table>';
                
                 $attempt=max($attempt);
             

               
               
               
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