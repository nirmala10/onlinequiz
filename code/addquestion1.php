

<?php
session_start();
include('header.php');
if(!empty($_SESSION['username']))
    {
      if(isset($_GET['categoryid'])&&(isset($_GET['quizid'])))
    {
          $con= mysqli_connect('localhost','root','nirmala12','quiz');
          $categoryid=$_GET['categoryid'];
          $quizid=$_GET['quizid'];
          echo $quizid;
          $number=$_GET['number'];
          $num=$_COOKIE['num'];
          if(isset($_GET['questionsalready']))
          {
          $alreadyadded=$_GET['questionsalready'];
          }
          $qn=$num-$number+1;
         
        //  echo "number of question to be entered".$number;
          
          $query="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
          $result= mysqli_query($con,$query);
         while($data=mysqli_fetch_array($result))
         {       
          $categoryname=$data[0];
         }
          $query="SELECT quizname FROM quizzes WHERE quizid='$quizid'";
          $result=mysqli_query($con,$query);
         while ($data=mysqli_fetch_array($result))
         {
          $quizname=$data[0];
         }
            echo "category selected:".$categoryname.'<br/>';
          echo "quiz selected:".$quizname.'<br/>';
          echo '<br>question number :';
          echo $qn;
          
          
         if(isset($_GET['submit']))
           { 
              $questionname=$_GET['questionname'];
              $question=$_GET['question'];
              $answer=$_GET['answer'];
              $number=$_GET['number'];
              $sql="INSERT INTO questions(questionname,question,answer,categoryid,quizid,questionnumber) VALUES('$questionname','$question','$answer','$categoryid','$quizid',$qn)";
              mysqli_query($con,$sql);
             
              print("<script>location.href='addquestion2.php?categoryid=$categoryid&quizid=$quizid&number=$number' </script>");
           }
       ?>






<html>
   <head>
        <title>home</title>
        <style>
           
            form
            {
                margin:10px;
            }
            
           input
           {
             margin:40px;
           }
        </style>
   
           
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
