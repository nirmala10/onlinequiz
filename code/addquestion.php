<?php
session_start();
include('header.php');
if(!empty($_SESSION['username']))
    
    
    {
    if(isset($_GET['categoryid'])||(isset($_GET['quizid'])))
    {
 $con=mysqli_connect('localhost','root','nirmala12','quiz');
 $categoryid=$_GET['categoryid'];
 //echo $categoryid;
 $quizid=$_GET['quizid'];

 $query= "SELECT categoryname FROM category WHERE categoryid='$categoryid'";
 $result=mysqli_query($con,$query);
 while($data=mysqli_fetch_array($result))
 {$categoryname=$data[0];}
 echo 'Categoryname:';
 echo $categoryname;
 echo '</br>';
 $query= "SELECT quizname FROM quizzes WHERE quizid='$quizid'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $quizname=$data[0];
  //echo "category selected:".$categoryname.'<br/>';
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

elseif(isset ($_GET['lateron']))
{
//redirect to home page
}


?>



<html>
    <head><head>
        <title>home</title>
        <style>
          
           input
           {
             margin:40px;
           }
        </style>
   
           
    </head>
        
    </head>
    <body> 
        
        <form action="addquestion.php" method="GET">
        <label>enter number of questions to be added</label><input type="text" name="number"/><br/>
       <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>"/>
       <input type="hidden" name="quizid" value="<?php echo $quizid ?>" /> 
       
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