

<?php
function db_connect($host,$username,$password,$dbname) 
{
 $con= mysqli_connect($host,$username,$password,$dbname);
if($con)
{
    echo 'connected';
}


else 
{
echo 'connection failed';
}
return $con;
}

function addcategory($con,$categoryname)
{ 
  $sql= "INSERT INTO category(categoryname) VALUES('$categoryname')";
         if(mysqli_query($con,$sql))
         {
          echo 'data inserted';
          printf("<script>location.href='categoryadded.php?category=$categoryname'</script>");
       
         }
         else
         {
          echo '<b class=error>Category Name already exist , Seleect a unique name</b>';    
         }   
    
    
    
    
}
function add_more_category($yes_or_no)
{
    if($yes_or_no == 'yes')
   {
    header('Location:addcategory.php');
   }
   elseif($yes_or_no=='no')
    {
    header('Location:home.php');
    }
}
function deletecategory($con,$selectedcategory,$categoryname)
{
    
                   $sql="DELETE FROM questions WHERE categoryid='$selectedcategory'";
                   mysqli_query($con,$sql);
                   $sql2="DELETE FROM quizzes WHERE categoryname='$categoryname'";
                   mysqli_query($con,$sql2);
                   $sql="DELETE FROM category WHERE categoryid='$selectedcategory'";
                   mysqli_query($con,$sql);
            
           printf("<script>location.href='deletecategory.php?deleted=$categoryname' </script>");
                   
                   
                 
}


function find_categoryname($con,$categoryid)
{
     $sql1="SELECT * FROM category WHERE categoryid='$categoryid'";
               // echo $sql1;
                  if($result1=mysqli_query($con,$sql1))
                          
                  {
                     $sql="SELECT * FROM category WHERE categoryid='$categoryid'"; 
                      
                  
                          echo 'executed';
                  }
                      else 
                          
                      {
                       echo 'not executed';
                      }
                  while($row1=mysqli_fetch_array($result1))
                  {
               
                
                   $categoryname=$row1['categoryname'];
                  }
                  echo $categoryid;
             return $categoryname;     
    
}
function find_quizname($con,$quizid)
{
   $query= "SELECT quizname FROM quizzes WHERE quizid='$quizid'";
 $result=mysqli_query($con,$query);
 $data=mysqli_fetch_array($result);
 $quizname=$data[0];
 return $quizname;
}
function insert_question($con,$questionname,$question,$answer,$categoryid,$quizid,$questionnumber)
{               $categoryname=  find_categoryname($con, $categoryid);
                $quizname=  find_quizname($con,$quizid);
 
              echo "category selected:".$categoryname.'<br/>';
              echo "quiz selected:".$quizname.'<br/>';
              echo '<br>question number :';
              echo $questionnumber;
              $sql="INSERT INTO questions(questionname,question,answer,categoryid,quizid,questionnumber) VALUES('$questionname','$question','$answer','$categoryid','$quizid','$questionnumber')";
              mysqli_query($con,$sql);
              print("<script>location.href='addquestion2.php?categoryid=$categoryid&quizid=$quizid&number=$number' </script>");
    
    
    
}
function add_more_question($yes_or_no,$number)
{
 
    if($yes_or_no=='yes')
{
  $number=$number-1;
   printf("<script>location.href='addquestion1.php?categoryid=$categoryid&quizid=$quizid&number=$number '</script>");
}
elseif($yes_or_no=='no')
{
     printf("<script>location.href='home.php?'</script>");
    
}
}

?>