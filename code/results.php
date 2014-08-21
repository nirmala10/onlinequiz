<?php
if(!empty($_SESSION['username'])){
$username=$_SESSION['username'];
echo $username;
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$query="SELECT id FROM users WHERE username='$username'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
 $userid=$row[0];
 }
$query="SELECT DISTINCT categoryid FROM answers WHERE userid='$userid'";

$result=mysqli_query($con,$query);
$i=0;
echo 'categories opted :<br>';
while($row=mysqli_fetch_array($result))
{
  $categoryid[$i]=$row[0];
  echo $row[0];
  $i++;
  echo '<br>';
}
$category_count=count($categoryid);


$query="SELECT  DISTINCT  quizid FROM answers WHERE userid='$userid'";
$result=mysqli_query($con,$query);

$i=0;
echo 'quizid opted :<br>';
while($row=mysqli_fetch_array($result))
{
  $quizid[$i]=$row[0];
 echo $row[0];
  $i++;
  echo '</br>';
}
$quiz_count=count($quizid);
//echo $quiz_count;

//print_r($quizid);

for($i=0;$i<$category_count;$i++)
{
    for($j=0;$j<$quiz_count;$j++)
    
        {  
        
       
              $query="SELECT count(*) AS c FROM answers  WHERE categoryid='$categoryid[$i]' AND quizid='$quizid[$j]'GROUP BY questionnumber ";
               $result=mysqli_query($con,$query);
               $c=0;
               echo 'No of attempts :';
               while($row=mysqli_fetch_array($result))
               {
               $row1[$c]=$row['c']; 
               $c++;
               }
               echo 'No of attempts :'.max($row1).'<br>';
                $attempts=max($row1);
               $start=0;
           for($a=0;$a<$attempts;$a++)
                    
              {
                
                
                // first to calculate number of question ...Reminder for me code to be addded here nd replace 15
                $query2="SELECT answer FROM questions WHERE categoryid ='$categoryid[$i]' AND quizid='$quizid[$j]' limit $start,15" ;
                $result2=mysqli_query($con,$query2);
                $k=0;
                
                while($row=mysqli_fetch_array($result2))
                 {  
                
                  $correctans[$k]= $row['answer']          ; 
                  $k++;
                  }
                    count($correctans);
                  echo '<br>';
               
                 $no_of_qn=count($correctans);
                 
                 $query1="SELECT  answers FROM answers WHERE userid='$userid' AND categoryid ='$categoryid[$i]' AND quizid='$quizid[$j]' ORDER BY 'questionid' ASC limit $start, $no_of_qn ";
                 $result1=mysqli_query($con,$query1);
                 $k=0;
                 while($row=mysqli_fetch_array($result1))
                     {  
                   
                     $optedans[$k]= $row['answers']          ; 
                      $k++;
                     }
              
                //echo 'Total number of questions :'.$no_of_qn.'<br/>';
             
                $count=0;
                for($l=0;$l<$no_of_qn;$l++)
                 {
                   if($optedans[$l]==$correctans[$l])
                     {
                    $count++;
                     }
                  else 
                   {
                     continue;
                   }
                 }
         
         
      
        
          echo '<br>';
           $attempt=$a+1;
          $start=$start+$no_of_qn;
        
          
          //$insertquery="INSERT INTO results(userid,categoryid,quizid,attempt_count,marks_obtained,outof) VALUES('$userid','$categoryid[$i]','$quizid[$j]','$attempt','$count',$no_of_qn)";
          //mysqli_query($con,$insertquery);
       }  
        
    }
     
       
    
}
  echo $count;
echo 'no of correct answers    ';
      echo 'for attempt '.$attempt." is  ";



include('footer.php');
}
else {
    header('Location:login.php:loginfirst');
    
}

?>

