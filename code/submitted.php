
<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
   if(isset($_GET['categoryid'])||(isset($_GET['quizid'])))
    { 
   
$con=mysqli_connect('localhost','root','nirmala12','quiz');

?>

<html>
    <head>
        <title>home</title>
        <style>
          .nvi
           {
               border: solid black 1px;
               margin:5px;
           }
            
           .maintable
           {
            margin:50px;
           }
           
           .cell
            {   
                margin:20px;
                border:solid goldenrod 1px;
            }
           
           
           
           
           
        </style>
    </head>
    <table class="maintable">
        <tr>
            <td class="nvi">
              <?php
              $sql="SELECT DISTINCT categoryname ,categoryid FROM category";
              //echo $sql;
             $result= mysqli_query($con,$sql);
             echo '<label> quiz categories</label>';
             echo '<ul>';
             $i=0;
            while($data=mysqli_fetch_array($result))
               { //$category[$i]=$data[0]?>
           <li><a href=clickedcategory.php?id=<?php echo $data[1];?>><?php echo $data[0]; ?></a></li>
         
               <?php 
                }
               echo '</ul>';
               ?>            
             </td>
   

            <td class='nvi' rowspan="2" >
                    
                <?php
                $marks_per_question=1;
                $categoryid=$_GET['categoryid'];
                $quizid=$_GET['quizid'];
                if(isset($_GET['lastid']))
                $lastid=$_GET['lastid'];
            
                $query="SELECT categoryname,quizname FROM quizzes WHERE quizid='$quizid'";
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_Array($result))
                {
                    $categoryname=$row['categoryname'];
                    $quizname=$row['quizname'];
                    
                }
                $username=$_SESSION['username'];
                echo 'Hello.....'. $username.'<br/>';
            
               $sql="SELECT id FROM users WHERE username='$username' ";
               $r=mysqli_query($con,$sql);
               $data=mysqli_fetch_array($r);
               $userid=$data['id'];
               $sql1="SELECT MAX(id) FROM answers ";
               $result1=mysqli_query($con,$sql);
              while($row=mysqli_fetch_array($result1))
               {
                   
              
                 $id=$row[0]      ;
                   
               }
              
               
               $sql1="SELECT MAX(questionnumber) FROM answers WHERE userid='$userid' categoryid='$categoryid' quizid='$quizid' ";
               $result1=mysqli_query($con,$sql);
              while($row=mysqli_fetch_array($result1))
               {
                   
              
                 $num=$row[0]      ;
                   
               }
              // echo $num;
               
               $query1="SELECT questionnumber, answers FROM answers WHERE userid='$userid' AND categoryid ='$categoryid' AND quizid='$quizid' AND id >'$lastid' ";
               $result1=mysqli_query($con,$query1);
               echo 'Category Name :'.$categoryname.'<br/>';
               echo 'QUIZ NAME :'.$quizname.'<br/>';
               
               //echo 'Attempted questions:';
               
               echo '</br><b> Your opted  answers.......:</b></br>';
               $k=1;
               
               while($row=mysqli_fetch_array($result1))
                 {  
                
                     $questionnumber[$k]=$row['questionnumber'];
                     echo $questionnumber[$k].".";
                     $optedans[$k]= $row['answers']          ; 
                     echo $optedans[$k].'<br>';
                      $k++;
                 }
                // echo 'U opted    :';
                //  print_r($optedans);
                $query2="SELECT answer FROM questions WHERE categoryid ='$categoryid' AND quizid='$quizid' " ;
                $result2=mysqli_query($con,$query2);
                $k=1;
                
                while($row=mysqli_fetch_array($result2))
                 {  
                  
                  $correctans[$k]= $row['answer']          ; 
                  $k++;
                  }
                  count($correctans);
             
                 echo '</br><b>correctans </b> :</br>';
                 ////
                 print_r($correctans);
                $no_of_qn=count($correctans);
               echo '<br>Total number of questions :'.$no_of_qn.'<br/>';
               // echo $no_of_qn;
                $count=0;
                for($i=1;$i<=$no_of_qn;$i++)
                 {  $j=$i;
                    if(in_array($j, @$questionnumber))
                    {
                               if(@$optedans[$i]==$correctans[$i])
                                   {
                                    $count++;
                                    }
                                   
                                    
                                    
                               
                    }
                     else
                                   {
                               continue;
                                   }
                                    
                    
                  
                    }
                 echo '<br>your correct answers :<b>'.$count.'</b> out of  '.$no_of_qn;
                 echo '<br>Marks Obtained :'.$count *$marks_per_question.'<br>';
                 echo ' <b>Your performance graph for this quiz</b></br>';
             
                $query="SELECT attempt_count FROM results WHERE userid='$userid' AND categoryid='$categoryid' AND  quizid='$quizid'";
                //echo $query;
                $result=mysqli_query($con,$query);
                $i=0;
                $found=mysqli_num_rows($result);
                
                $attempt_count=$found+1;
               // echo $attempt_count;
                echo $_GET['flag'];
             
           
                $sql="INSERT  INTO  results(userid,username,categoryid,categoryname,quizid,quizname,attempt_count,marks_obtained,outof)VALUES ('$userid','$username','$categoryid','$categoryname','$quizid','$quizname','$attempt_count','$count','$no_of_qn')";
                mysqli_query($con,$sql);
             
               
                $sql="SELECT marks_obtained ,attempt_count FROM results WHERE userid='$userid' AND  categoryid='$categoryid' AND quizid='$quizid'";
//echo $sql;
$qt=mysqli_query($con,$sql);
$i=0;
while($data=mysqli_fetch_array($qt))
{
$marks[$i]=$data['marks_obtained'];
$attempt[$i]=$data['attempt_count'];
$i++;
}
echo '<div>';
function chart_data($values) {

// Port of JavaScript from http://code.google.com/apis/chart/
// http://james.cridland.net/code

// First, find the maximum value from the values given

$maxValue = max($values);

// A list of encoding characters to help later, as per Google's example
$simpleEncoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 
$chartData = "s:";
  for ($i = 0; $i < count($values); $i++) {
    $currentValue = $values[$i];

    if ($currentValue > -1) {
    $chartData.=substr($simpleEncoding,61*($currentValue/$maxValue),1);
    }
      else {
      $chartData.='_';
      }
  }
 echo ' your highest score for this test   is :'.$maxValue;
// Return the chart data - and let the Y axis to show the maximum value
return $chartData."&chxt=y&chxl=0:|0|"."marks";
}


echo "<img src=http://chart.apis.google.com/chart?chtt=".urlencode("your performance graph between marks and attempts  of this quiz!")."&cht=lc&chs=450x125&chd=".chart_data($marks).">";


$marks = json_encode($marks);
$attempt=json_encode($attempt);


echo '</div>';


                
                
                
                 /*echo '<form style="text-align:right;" action=graph.php method=GET>';
                 echo "<input type=hideen name= categoryid value=$categoryid";
                 echo "<input type=hidden name=quizid value= $quizid";
                 echo '<input type=submit name=submit value= "See ur performance graph for this quiz"/>';
                 echo '</form>';
                 
                */ 


 
                 $query2="SELECT  *FROM results WHERE userid='$userid'";
            
                 $result=mysqli_query($con,$query2);
                 $num=mysqli_num_rows($result);
                 if($num==null)
                 {
                     echo 'you dint appear for any quiz previously<br/>';
                 exit;
                 }
                
                 echo '</br><b>Your previous score</b><br/>';
                 
                 $m=0;
                 echo '<table class=maintable><tr><th class=cell>';
                 echo 'Categoryname</th ><th class=cell>';
                 echo 'quizname</th><th class=cell>';
                 echo 'Attempt count</th><th class=cell>';
                 echo 'Marks obtained</th><th class=cell>';
                 echo 'Out of</th></tr>';
                 
                 while($row=mysqli_fetch_array($result))
                 {   echo '<tr><td class= cell>';
                     echo $row['categoryname'];
                     echo '</td><td class=cell>';
                     echo $row['quizname'];
                     echo '</td><td class= cell>';
                     $attempt[$m]=$row['attempt_count'];
                   
                     echo $row['attempt_count'];
                     echo '</td><td class= cell>';
                     $marks_obtained[$m]=$row['marks_obtained'];
                    
                     echo $row['marks_obtained'];
                     echo '</td><td class= cell>';
                     echo $row['outof'];
                     echo '</td></tr>';
                    
                 $m++;
                 }
                 echo '</table>';
                
               //  $attempt=max($attempt);
             

               
               
                 
                 
                 
                 
        
                 
       unset($categoryid);
           
    }
    else{
        header('Location:home.php');
    
    }
    ?> 
                
                
                
            </td>
      
            
        </tr>
        <tr>
         <td class='nvi' >
             <h3> Administrative </h3>
             <ul>
                 <?php
                if(isset($_SESSION['role'])){
                echo "<b style=color:green;>Signed in role as :".$_SESSION['role']."</b>";
                }
                
                
                
/*NOTE: That is to hide hyperlink*/
?> 
                 
            <li>
            <h4>edit category </h4>
           
            <ul> 
                <li>
                    <a href="addcategory.php" <?php if($role=='student'){ echo 'style=display:none';}?>>Add category </a> 
                </li>
                <li>
                    <a href="deletecategory.php"<?php if($role=='student'){ echo 'style=display:none';}?>>Delete category </a>
                    
                </li>
                
                    
               
            
             </ul>
             </li>
             <li> 
                 <h4> edit quizzes </h4>
                 <ul>
                     <li>
                         <a href="addquiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >Add quiz </a>
                     </li> 
                     <li>
                         <a href="deletequiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >delete quiz</a>
                     </li>
                     <li>
                         <a href="editquiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >edit a quiz </a>
                     </li>
                     
                     
                 </ul>
                 
                 <li>
                         <a href="role.php"<?php if($role=='student'||$role=='teacher'){ echo 'style=display:none';}?> >edit role </a>
                     </li>
                     <li>
                         <a href="previousresult.php" >Your Previous results </a>
                     </li>
                     <li>
                         <a href="overallperformance.php"<?php if($role=='student'||$role=='teacher'){ echo 'style=display:none';}?> > overall Performance of all students </a>
                     </li>
                 
             </li>
            
             
            </ul>
        </div>
            
         </td>
        </tr>
        </table>
    
   
  





</html>

<?php
include('footer.php');

}
 else 
    
 {
   header('Location:login.php?loginfirst'); 
 }
?>



























