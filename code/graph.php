

<?php
session_start();
include('header.php');
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$username=$_COOKIE['username'];
$query= "SELECT id FROM users WHERE username= '$username'";
$result=mysqli_query($con,$query);
while($row=mysqli_fetch_array($result))
{
   $userid= $row[0];
}






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



echo "<img src=http://chart.apis.google.com/chart?chtt=".urlencode("your performance graph between marks and attempts  of this quiz!")."&cht=lc&chs=450x125&chd=".chart_data($marks).">";


$marks = json_encode($marks);
$attempt=json_encode($attempt);

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
echo '</div>';
include('footer.php');
?>







