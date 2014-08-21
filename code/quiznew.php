<?php
 include('header.php');
 session_start();
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
 }
 countdown();
 if(hour==0&&min==0&&sec==0)
 {  alert("time out");
 
unset($_SESSION['ts']);
 
    }
 
 
 
</script>

<script>
   // function()
  //  {
 //  document.getElementByName('next').onClick= function()
   // {
   // var form= document.getElementByName('myform'); 
   // form.elements.link=this.href;
   // form.submit();
   // };
  //  }
 /* var ans= new Array();
  
  function  funct2(n,start)
    { alert(start);
       var k=0;
        for(var i=start;i<=n; i++)
        {
            var radios= document.getElementsByName(i);
        
            
         for(var m=0;m<radios.length;m++)
           
          {
             if(radios[m].checked)
             {
               var ans1=radios[m].value;
               
               document.getElementsByName(i).value=ans1;
               break;
             }
         }
         ans[k]=document.getElementsByName(i).value;
         k++;
     }
     //alert(ans);
        var name="ans";
        var expires="Thu, 29 jul 2014 12:50:11 UTC";
      document.cookie=name+"="+ans+"; expires=expires; path=/;  domain=<?php //echo $_SERVER['HTTP_HOST']; ?>";
     
    } */
</script> 





 













<?php


$start=$_GET['start']+$n;
 $n=5;


 $con=mysqli_connect('localhost','root','nirmala12','quiz');
 $username=$_SESSION['username'];
 $sql="SELECT id FROM users WHERE username='$username' ";
//$qz_id=array();
 
 $r=mysqli_query($con,$sql);
 $data=mysqli_fetch_array($r);
 $userid=$data['id'];
 //$ans=($_COOKIE['ans']);
 $varans=explode(',',$ans);
 $qz_id=$_GET['q_id'];

// print_r($qz_id);
 
 $pagename='quiz.php';
 $category=$_GET['category'];
 $quizname=$_GET['quizname'];
 echo "category selected for quiz :".$category.'<br/>';
 echo "Quiz selected :".$quizname.'<br/>';
 $query= "SELECT categoryid FROM category WHERE categoryname='$category'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $categoryid=$data[0];
 $query= "SELECT quizid FROM quizzes WHERE quizname='$quizname'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $quizid=$data[0];
 $query= "SELECT question,q_id FROM questions WHERE categoryid=$categoryid AND quizid='$quizid'limit $start,$n";
 echo $query;
 $result2=mysqli_query($con,$query);
 $k=0;
    
 
 $query= "SELECT * FROM questions  WHERE categoryid='$categoryid' AND quizid='$quizid'";
 $count= mysqli_query($con,$query);
  $found=mysqli_num_rows($count);
 echo '<b>questions :</b>';
 echo $found.'<br/>';
 $page=ceil($found/$n);
 echo "total page :".$page.'<br/>';
 echo '<div>';
 echo'</div>';
 $i=$start+1;

   $sql= "SELECT answer FROM questions WHERE categoryid='$categoryid' AND quizid='$quizid'"; 
   echo $sql;
$data1=mysqli_query($con,$sql);

$a=0;
while($row=mysqli_fetch_array($data1))
{
 $answers[$a]=$row[0];
 $a++;
}


if(!isset($_GET['next1']))
{
    
    $start=0;
    echo 'next1';
 }
 else
{ print_r($qz_id);
  
      foreach($qz_id as $key => $val)
    { 
          echo 'hello';
      

         $array = explode(' ', $val);
      echo $array[0];


           $sqll= "INSERT INTO answers(userid,questionid,categoryid,quizid) VALUES('$userid','$val','$categoryid','$quizid') ";
           mysqli_query($con,$sqll);
          echo $sqll;
          $m++;
         
    }
    

    
 
    
    
     
   $k=1;
     $saveans=$_GET['savedans'];
    $start=$_GET['start'];
     foreach( $_GET as $j=>$val)
        {
           
        if($j=='category')
        { 
            break;
        }
        else
        {
         $savedans[$j]=$val;
         echo $val;
         
          $sqll="UPDATE answers SET answers='$val' WHERE userid='$userid'AND categoryid='$categoryid'AND quizid='$quizid'AND questionid='$k'";
          
          mysqli_query($con,$sqll); 
        $k++;
        }
      
   }
 
 
}












if(!empty($_GET['submit1']))
{   

    $j=0;
  
        foreach( $_GET as $j=>$val){
        if($j=='category')
        { 
            break;
        }
        else
        {
         // $val1=(boolean)$val;
         // $optedans=$val;
         // print_r($optedans);
          //$query="SELECT answer FROM questions ";
         // $result1=mysqli_query($con,$query);
         //$data=mysqli_fetch_array($result1);
         
         $questionid=$q_id[$j];
         $sql="INSERT INTO answers(userid,questionid,answers,categoryid,quizid) VALUES('$userid','$questionid',$val','$categoryid','$quizid')";
          mysqli_query($con,$sql); 
            
        } 
        $i++;
       }
      printf("<script>location.href='submit.php?categoryname=$category&quizname=$quizname'</script>");
      exit();
  }
      
   


else{
?>




<html>
    <head>
        
    </head>
    <body>
        <form action="quiznew.php" method="GET" name="myform"> 
            <?php
            $k=0;
        
            while($row=mysqli_fetch_array($result2))
           {  
             echo $i.'. '. $row['question'];
             echo'<br/>';
               $q_id[$k]= $row['q_id']          ; 
              ?>
            <input type='radio' name="<?php echo $i; ?>" value="true" /> True
            <input type= radio name="<?php echo $i; ?>" value="false" />false<br/><br/>
           <?php
           $i++;
           echo '</div>'; 
           $k++;
            }
           
          
                ?>
            
            <input type="hidden" name=' category' value="<?php echo $category;   ?>" />
            <input type='hidden' name='quizname' value="<?php echo $quizname ;?>"/>
           <input type="hidden" name="q_id[]" value="<?php print_r($q_id);?>" /> 
            <input type="hidden" name="<?php echo $i; ?>" value=""/>
            <input type='hidden' name='start' value="<?php echo $start+$n ;?>"/>
            <?php if ($start>=$n*($page-1))
             {
             echo '<input type="submit" name="submit1" value="submit " />';
              
             }
             
           else 
           {
               echo '<input type="submit" name="next1" value="next" />';
           ?> 
             <input type="hidden" name="savedans" id="saveans" value="<?php print_r($savedans);?>"/>
           
          <?php  } 
     
         
        ?>
           
        </form>'
    </body>
    
</html>
<?php
/* <a  name="next"href="quiznew.php?category=<?php echo $category; ?>&quizname=<?php echo  $quizname ?>&start=<?php echo $start+$n;?>&q_id[]=<?php print_r($q_id);?>" onclick="funct2('<?php echo $i-1;?>','<?php echo $start+1;?>')">next </a>*/
/*<input type='radio' name="<?php echo $i; ?>" value="true" onClick="funct('<?php echo $i?>','<?php echo $n ?>');" />True<input type=radio name="<?php echo $i; ?>" value=false onClick="funct('<?php echo $i ?>','<?php echo $n ?>');" />false<br/><br/> */
include('footer.php');}
?>