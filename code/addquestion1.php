

<?php
session_start();
include('header.php');
include('liv.php');
include('repeatedhtmlpart.php');
if(!empty($_SESSION['username']))
    {  $con= db_connect('localhost','root','nirmala12','quiz');
      if(isset($_GET['categoryid'])&&(isset($_GET['quizid'])))
    {
      $categoryid=$_GET['categoryid'];
      $quizid=$_GET['quizid'];
      $number=$_GET['number'];
      $num=$_COOKIE['num']; // starting question number for the next page
         if(isset($_GET['questionsalready']))
          {
          $alreadyadded=$_GET['questionsalready'];
          }
          $qn=$num-$number+1;// to  question number
           if(isset($_GET['submit']))
           { 
              $questionname=$_GET['questionname'];
              $question=$_GET['question'];
              $answer=$_GET['answer'];
              $number=$_GET['number'];
              //save question in the data base
              insert_question($con,$questionname,$question,$answer,$categoryid,$quizid,$qn);
           }
       ?>
<html>
   <head>
        <title>home</title>
        <link rel='stylesheet' type='text/css' href='quiz.css' />
           
  </head> 

    <div>
    <form action="addquestion1.php" method="GET" >
    <labe> question name</label><input type="text"  name="questionname" required/><br/>
    <label>question</label><textarea name="question" rows="4" required > </textarea><br/>
    <label>answer</label><input type="radio" name="answer" value="true" required/>true
          <input type="radio" name="answer" value="false"/>false<br/>
          <input type="hidden" name="categoryid" value="<?php echo $categoryid; ?>"/>
          <input type="hidden" name="quizid" value="<?php echo $quizid; ?>"/>
          <input type="hidden" name="number" value="<?php echo $number; ?>"/>
         
    <input type="submit" name="submit" value="submit">
    
    </form>
    </div>
</html>

<?php include('footer.php');
    }
    else{
        echo 'No quiz id or category id selected';
    }
    
}
else {
 
     header("Location:login.php?loginfirst");
    
 }
?>
