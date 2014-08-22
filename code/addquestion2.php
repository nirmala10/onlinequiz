<?php
session_start();
include('header.php');
include('liv.php');
include('repeatedhtmlpart.php');
if(!empty($_SESSION['username'])){
   if(isset($_GET['categoryid'])||(isset($_GET['quizid'])))
    { 
    
$categoryid=$_GET['categoryid'];
$quizid=$_GET['quizid'];
  $number=$_GET['number'];
  if(isset($_GET['y_n']))
     {
    
     $yes_or_no=$_GET['y_n'];
     add_more_question($yes_or_no,$number);
     }

?>
<html>
    <head>
        <head>
        <title>home</title>
        <link rel='stylesheet' type='text/css' href='quiz.css'/>
     </head>
  
    <body>
        <div>
       Do you want to add more question ?
        </div>
        <form method="GET" action="addquestion2.php">
          <input type="hidden" name='categoryid' value="<?php echo $categoryid  ?>" />
          <input type="hidden" name="quizid" value="<?php echo $quizid ?>" />
          <input type='hidden' name='number' value="<?php echo $number?>" /> 
        <input type="submit" name="y_n" value="yes"/>
        <input type="submit" name="y_n" value="no"/>
        </form>
    </body>
    
    
    
</html>
<?php include('footer.php')  ;
}
 else {
    echo 'No quiz id or category is selected';
}

}

 else
     {
    
     header("Location:login.php?loginfirst");
     
   }



?>