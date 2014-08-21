
<?php 
session_start();
include('header.php');
 if(!empty($_SESSION['username'])){
?>



<html>
    <b> Question edited successfully</b> <br/>
    <b> Do you want to edit more questions'''''</b> 
    
    <form action='editquiz1.php' method='GET'>
    <input type =submit name= yes value= yes>
    
     </form>
    
    <form >
    <input type=submit name=no value=no>
    
    </form>
    
</html> 

   

<?php
 include('footer.php');}
 
 else {
    header('Location:login.php?loginfirst');
}
?>
