<?php
session_start();
include('header.php');
include('repeatedhtmlpart.php');
include('liv.php');

if(!empty($_SESSION['username']))
 { $role=$_SESSION['role'];
   $con=db_connect('localhost','root','nirmala12','quiz');
   if(isset($_GET['y_n']))
     {
     $yes_or_no=$_GET['y_n'];
     add_more_category($yes_or_no);
 
     }
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
                   <?php display_categories($con); ?>
                </td>
                <td class="nvi" rowspan =2>
                   <form method="GET" action="categoryadded.php">
                   <label><b>Do you want to add more category ?</b></label><br/>
                   <input type="hidden" name='category' value="<?php echo "$category" ?>" />
                   <input type="hidden" name="quizname" value="<?php echo "$quizname"  ?>" />
                   <input type="submit" name="y_n" value="yes"/>
                   <input type="submit" name="y_n" value="no"/>
                   </form>
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
include('footer.php');
}
else 
 {
   header("Location:login.php?loginfirst");
 }
 ?>

