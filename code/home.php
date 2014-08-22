<?php
session_start();
include('header.php');
include('liv.php');
include('repeatedhtmlpart.php');
 $con=db_connect('localhost','root','nirmala12','quiz');
 if(!empty($_SESSION['username']))
{
if(!empty($_SESSION['role'])){ $role=$_SESSION['role'];} 
?>
<html>
    <head>
        <title>home</title>
        <link rel="stylesheet" type="text/css" href="quiz.css" />
           
    </head>
    <body>
    <div> 
        <table class="maintable">
            <tr>
                <td class="nvi">
                    <?php
                    if(isset($_REQUEST['timeout']))
                     {
                     echo '<b style= color:red;></br/>Your time expired,Answers not saved.........Appear again</br></b>';
                      }
                    display_categories($con);
                    ?>            
                </td>
                <td class="nvi" rowspan =2>
                    <img src="../image2.jpeg"width="500" height="200"/>
                </td>
          
            </tr>
            <tr>
                <td class="nvi">
                   <div>
                     <?php display_admin_task($role); ?>
                   </div>
            
               </td>
            </tr>
        </table>
    </div>
    </body>
</html>
<?php


 }
 else {
     header("Location: login.php?loginfirst");
}

 

    

?>
