<?php
session_start();
include('header.php');
include('repeatedhtmlpart.php');
include('liv.php');
$con=db_connect('localhost','root','nirmala12','quiz');
$role=$_SESSION['role'];
if(!empty($_SESSION['username']))
 {
       if(isset($_POST['submit']))
        {  
         $categoryname=$_POST['category'];
         addcategory($con,$categoryname);
        }


?> 

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="quiz.css"/>
    </head>
    
    <table class="maintable" >
            <tr>
                <td class="nvi">
                <?php  display_categories($con);  ?>
                </td>
                <td class="nvi" rowspan="2"> 
                   <form action="addcategory.php" method="POST" align="right">
                   <label>Enter category name :</label><input type ="text" name="category" align="top"  required/><br/>
                   <input type="submit" name="submit" value="add Category" align="right"/>
                   </form>
                </td>
            </tr>
            <tr>
                <td class="nvi">
                <div>
                 <?php  display_admin_task($role); ?>
                 </div>
                </td>
            </tr>
    </table>
                </div>
</html>
<?php include('footer.php'); 
}


else
{
     header("Location: login.php?loginfirst");
}
?>