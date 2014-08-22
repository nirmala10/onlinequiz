<?php
session_start();
include('header.php');
include('liv.php');
include('repeatedhtmlpart.php');
;
if(!empty($_SESSION['username']))
{
    $con=db_connect('localhost','root','nirmala12','quiz');
    
    
    if(isset($_GET['categoryid'])||(isset($_GET['quizid'])))
    {
           
            $categoryid=$_GET['categoryid'];
 //echo $categoryid;
             $quizid=$_GET['quizid'];
            $categoryname=find_categoryname($con,$categoryid);
            echo 'Categoryname:';
            echo $categoryname;
            echo '</br>';
            $quizname=find_quizname($con,$quizid);
            echo "quiz selected:".$quizname.'<br/>';
           $query1="SELECT * FROM questions where categoryid='$categoryid' AND quizid='$quizid' ";
           $result=mysqli_query($con,$query1);
           $numalready=mysqli_num_rows($result);
           echo $numalready;
 
 
if (isset($_GET['addquestion']))
{
    
   
   $number= $_GET['number'];
   setcookie('num',$number+$numalready);
    printf("<script>location.href='addquestion1.php?categoryid=$categoryid&quizid=$quizid&number=$number&questionsalready=$numaready'</script>");
    exit();
}


?>



<html>
    <head>
        <title>home</title>
        <link rel="stylesheet" type="text/css" href="quiz.css" />
     </head>
    <body> 
        
        <form action="addquestion.php" method="GET">
        <label>enter number of questions to be added</label><input type="text" name="number"/><br/>
       <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>"/>
       <input type="hidden" name="quizid" value="<?php echo $quizid; ?>" /> 
       
         <input type="submit" name="addquestion" value="add questions in the quiz"/><br/>
        </form> 
         <labe> OR </label><br/>
         <form action="home.php">
         <input type="submit" name="lateron" value="add questions later on"/>
        </form>
      
        
    </body>
</html>
<?php 

 





    }
 else 
        
 {
    echo '<b.Select a category or quiz </b>'; 
 }

    }
else 
    
 {
    header("Location: login.php?loginfirst");  
 }

include('footer.php');
?>