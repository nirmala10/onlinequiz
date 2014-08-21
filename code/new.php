<?php
session_start();
 include('header.php');
 if(!empty($_SESSION['username'])){
 $con=mysqli_connect('localhost','root','nirmala12','quiz');
 $categoryid= $_GET['categoryid'];
 echo $categoryid;
 $quizid= $_GET['quizid'];
 $username=$_SESSION['username'];
 if(isset($_GET['lastid']))
 $lastid=$_GET['lastid'];
 if(isset($_GET['next1'])|| isset($_GET['submit1']))
 {
  $start=$_GET['start']+@$n;
  $n=5;
  // echo $start.'.....'; 
 }
 else
 {
 $start=0;
 $query="SELECT MAX(id) FROM answers ";
 $result=mysqli_query($con,$query);
 $data1=mysqli_fetch_array($result);
 $lastid=$data1[0];
 //echo $lastid.'<br>';
 }
 //$qn_id=$_GET['q_id'];
 $n=5;
// echo $start;
 $sql="SELECT id FROM users WHERE username='$username' ";
 $r=mysqli_query($con,$sql);
 $data=mysqli_fetch_array($r);
 $userid=$data['id'];//logged in usesr's id
 // to find category id of the category selected
 $query= "SELECT categoryname FROM category WHERE categoryid='$categoryid'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $categoryname=$data[0];
 echo '........';
 echo $categoryid;
 // to find quiz id of the quiz selected this is unique
 $query= "SELECT quizname FROM quizzes WHERE quizid='$quizid'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $quizname=$data[0];// id of the quiz selected this is unique
 
$query="SELECT questionnumber FROM questions WHERE categoryid='$categoryid' AND quizid='$quizid'";
$result=mysqli_query($con,$query);
//echo $query;
$q=0;
while($row= mysqli_fetch_array($result))
{
    $qen[$q]=$row[0];
    $q++;
}
echo '<div style="margin:40px;border:solid black 1px;">';
//print_r($qen);
$number=max($qen);//no of questions in the quiz
echo '<table style="border:solid black 2px;margin:20px;;"><tr><th>';
echo 'categoryname     ';
echo '</th><th>';
echo 'quizname     ';
echo '</th><th>';
echo 'Total number of question     ';
echo '</th><th>';
$page=ceil($number/$n);
echo 'Total Number of pages    ';
echo '</th><th>';
echo 'Remaining time       ';
echo '</th></tr><tr><td class=head>';
echo $categoryname;
echo '</td><td class=head>';
echo $quizname;
echo '</td><td class=head>';
echo $number;
echo '</td><td class=head>';

 

echo '<b>' .$page.'</b></br>';
echo '</td><td class=head>';
$timestamp = time();
//role teacher set timere enter the value of timer 
$diff = 30; //<-Time of countdown in seconds.  ie. 3600 = 1 hr. or 86400 = 1 day.

//MODIFICATION BELOW THIS LINE IS NOT REQUIRED.
$hld_diff = $diff;
if(isset($_SESSION['ts'])) {
	$slice = ($timestamp - $_SESSION['ts']);	
	$diff = $diff - $slice;
}

if(!isset($_SESSION['ts']) || $diff > $hld_diff || $diff < 0) {
	$diff = $hld_diff;
	$_SESSION['ts'] = $timestamp;
}

//Below is demonstration of output.  Seconds could be passed to Javascript.
$diff; //$diff holds seconds less than 3600 (1 hour);

$hours = floor($diff / 3600) . ' : ';
$diff = $diff % 3600;
$minutes = floor($diff / 60) . ' : ';
$diff = $diff % 60;
$seconds = $diff;

    

?>
<div id="strclock">Clock Here!</div>
<script type="text/javascript">
 var hour = <?php echo floor($hours); ?>;
 var min = <?php echo floor($minutes); ?>;
 var sec = <?php echo floor($seconds); ?>
 
function countdown() {
 if(sec <= 0 && min > 0) {
  sec = 59;
  min -= 1;
 }
 else if(min <= 0 && sec <= 0) {
  min = 0;
  sec = 0;
 }
 else {
  sec -= 1;
 }
 
 if(min <= 0 && hour > 0) {
  min = 59;
  hour -= 1;
 }
 
 var pat = /^[0-9]{1}$/;
 sec = (pat.test(sec) == true) ? '0'+sec : sec;
 min = (pat.test(min) == true) ? '0'+min : min;
 hour = (pat.test(hour) == true) ? '0'+hour : hour;
 
 document.getElementById('strclock').innerHTML = hour+":"+min+":"+sec;
 
 setTimeout("countdown()",1000);
 if(hour==0&&min==0&&sec==0)
 {  //alert("time out");
     window.location.href = "home.php?timeout";
   //window.location = "submitted.php?categoryid=<?php echo $categoryid; ?>&quizid=<?php echo $quizid ;?>";
 }
 
 
 }
 
 countdown();
 
 
    
 
 
 

 
</script>

</td>
</tr>
</table>



<html>
    <head><style>
          .nvi
           {
               border: solid black 1px;
               margin:5px;
           }
            
           .maintable
           { //background-color: antiquewhite;
            margin:50px;
           }
           input{
               
              margin:30px;
           }
           .heading
           {
             border-color: green;
             border-width: 2px;
           }
           form
           {
              
               
               margin:50px;
           }
           .head{
               border:solid black 1px;
               color:brown;
           }
           
        </style>
        
    </head>
    <body>
        <form action="" method="new.php" name="GET" >
            <?php
            // $i=1;
           
              $query= "SELECT question, questionnumber FROM questions WHERE categoryid='$categoryid' AND quizid='$quizid'limit $start,$n";
               $result=  mysqli_query($con,$query);
              // echo $query;
                $found=mysqli_num_rows($result);
                    $i=$start+1;
                    echo '<br>';
                    $q=0;
               while($row=mysqli_fetch_array($result)){
                          echo $i." .    ";
                          $questionnumber1[$i]=$row[1];
                          //echo $questionnumber1[$q];
                          echo $row[0];
                          echo "<br><input type=radio name=$i  value=true>True.
                          <input type=radio name=$i value=false>False<br>";
                          $i++;
                          $q++;
               } 
               $i=$start+1;
               
               if($found==null&&$start==null)
               {
                 echo '<br/><b style="color:red;">Questions are not added in the quiz yet<b>'; 
                 exit;
               }
               
                  $start=$start+$n;
                    echo "<input type=hidden name= categoryid value='$categoryid' />";
                    echo "<input type= hidden name= quizid  value= $quizid />";
                    echo "<input type= hidden name= start value=$start />";
                    echo "<input type= hidden name= lastid value=$lastid />";
                    echo "<input type=hidden name=i value=$i />";
                    
            ?>
          <!-- <input type="hidden" name="q_id" value="<?php// print_r($q_id);?>" /> -->
            
            <?php if ($start>$n*($page-1))
             {
             echo '<input type="submit" name="submit1" value="submit " />';
              
             }
             
           else 
           {
               echo '<input type="submit" name=next1 value="next" />';
           }
           ?> 
            
            
<?php
if (!empty($_GET['next1']))
    { 

    
          

  // echo $i;
        
         foreach($_GET as $key => $val)
          {  
            if($key=='categoryid')
                
                    break;
                else
                    {
                     
                     
                   
                 
                     $sqll= "INSERT INTO answers(userid,answers,categoryid,quizid,questionnumber) VALUES('$userid','$val','$categoryid','$quizid','$key') ";
                     mysqli_query($con,$sqll);
                   //  echo $a;
                     // echo $val;
            //echo $sqll;
                
                    
                    }
          }
       
        
         
    }





elseif(isset($_GET['submit1']))
{
 $_SESSION['ts'] = '';
  $i=$_GET['i'];
    echo "submit---------------";
         $a=$start+1;
      
         foreach($_GET as $key => $val)
          {  
            if($key=='categoryid')
                    break;
                else
                    {
                    
            
                 $sqll= "INSERT INTO answers(userid,answers,categoryid,quizid,questionnumber) VALUES('$userid','$val','$categoryid','$quizid','$key') ";
                mysqli_query($con,$sqll);
      
                    }
          }
    
    
     printf("<script>location.href='submitted.php?categoryid=$categoryid&quizid=$quizid&lastid=$lastid&flag=1'</script>");
     exit();
       
    
}

?>


</form>
     </body>  
     </html>
     
     
  <?php
  include('footer.php');
 }
 else 
     
 {
   header('Location:login.php?loginfirst');  
 }
  
  ?>
     
     
     