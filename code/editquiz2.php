<html>
    <head>
        <style>
            input,textarea{
                margin:40px;
            }
            form{
                margin:40px;
                padding:30px;
            }
        </style>
    </head>


<?php
session_start();
include('header.php');
 if(!empty($_SESSION['username'])){
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$categoryid=$_GET['categoryid'];
$sql1="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
$result=mysqli_query($con,$sql1);
while($row=mysqli_fetch_array($result))
{
 $categoryname=$row['categoryname'];
}

$quizid=$_GET['quizid'];
$sql1="SELECT quizname FROM quizzes WHERE quizid='$quizid'";
$result=mysqli_query($con,$sql1);
while($row=mysqli_fetch_array($result))
{
 $quizname=$row['quizname'];
}


//echo $categoryid;
$quizid=$_GET['quizid'];
$questionnumber=$_GET['questionnumber'];
$query="SELECT question, answer FROM questions WHERE categoryid='$categoryid' AND quizid='$quizid' AND questionnumber='$questionnumber'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
$question=$row['question'];
$answer=$row['answer'];
//echo $answer;
}




if(isset($_GET['save']))
{
$categoryid=$_GET['categoryid'];
$quizid=$_GET['quizid'];
$questionnumber=$_GET['questionnumber']; 
    
$changedquestion= $_GET['question'];
$changedanswer=$_GET['answer'];
$query="UPDATE questions SET question='$changedquestion' ,answer='$changedanswer' WHERE categoryid='$categoryid' AND quizid='$quizid'AND questionnumber=$questionnumber ";
if(mysqli_query($con,$query))
{
    echo 'questionupdated successfully.....<br>';
    echo 'Do you want more edits in the quiz <br>';
    echo  "<form action='editquiz1.php' method='GET' style='display:inline;margin:40px;'>
    <input type =submit name= yes value= yes>
    <input type=hidden name=categoryid value=$categoryid>
    <input type= hidden name=quizid value=$quizid >
     </form>
    
    <form action=home.php style='display:inline;'>
    <input type=submit name=no value=no>
    </form>";
    
 }     
}


else{
echo 'question Number: '.$questionnumber;
?>

<form action="editquiz2.php" method="GET">
  <textarea name=question rows='5' columns='25'> <?php echo $question; ?></textarea><br/>
  <input type='radio' name='answer' value="true" <?php  if(($answer=="true")){ echo 'checked="checked"';} ?>/>true
  <input type='radio' name='answer' value="false"<?php  if(($answer=="false")){ echo 'checked="checked"';} ?>/>False<br/>

 <input type=hidden name=categoryid value=<?php echo $categoryid; ?>>
  

 <input type=hidden name=quizid value=<?php echo $quizid; ?>>
  

 <input type=hidden name=questionnumber value=<?php echo $questionnumber; ?>>
  <input type=submit name=save value=Save >
</form>
</html>

<?php 
}
 include('footer.php');}
 
 else{
     
     header("Location:login.php?loginfirst");
 }
?>