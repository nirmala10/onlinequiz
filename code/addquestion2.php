<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
   if(isset($_GET['categoryid'])||(isset($_GET['quizid'])))
    { 
    
$categoryid=$_GET['categoryid'];
$quizid=$_GET['quizid'];
  $number=$_GET['number'];
if(isset($_GET['yes']))
{
  $number=$number-1;
   printf("<script>location.href='addquestion1.php?categoryid=$categoryid&quizid=$quizid&number=$number '</script>");
}
elseif(isset($_GET['no']))
{
     printf("<script>location.href='home.php?'</script>");
    
}










?>




<html>
    <head>
        <head>
        <title>home</title>
        <style>
         
           
           input
           {
             margin:50px;
           }
        </style>
   
           
    </head>
    </head>
    <body>
        <div>
       Do you want to add more question ?
        </div>
        <form method="GET" action="addquestion2.php">
          <input type="hidden" name='categoryid' value="<?php echo $categoryid  ?>" />
          <input type="hidden" name="quizid" value="<?php echo $quizid ?>" />
          <input type='hidden' name='number' value="<?php echo $number?>" /> 
        <input type="submit" name=" yes" value="yes"/>
        <input type="submit" name=" no" value="no"/>
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