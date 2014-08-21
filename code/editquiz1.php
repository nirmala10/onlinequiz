<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
 
@$quizid=$_GET['quizid'];

 $con=mysqli_connect('localhost','root','nirmala12','quiz');
   


                
                   $categoryid = $_GET['categoryid'];
                   echo $categoryid;
                   $sql="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
                   $quizid = $_GET['quizid'];
                 //echo $quizid;
                   $result=mysqli_query($con,$sql);
                   $row=mysqli_fetch_array($result);
                  $categoryname=$row['categoryname'];
               
                   $sql="SELECT quizname FROM quizzes WHERE quizid='$quizid'";
                   $result=mysqli_query($con,$sql);
                   $row=mysqli_fetch_array($result);
                  // $quizid=$row['quizid'];
                   $sql="SELECT question,answer FROM questions WHERE categoryid='$categoryid'AND quizid='$quizid'";
                   $i=1;
                   //echo $sql;
                  $result=  mysqli_query($con,$sql);
            
                
                    echo '<br>';
                    echo '<form action=editquiz1.php method=GET>';
                    echo '<input class=newquestion type= submit name=addquestion value= "add new question"/><br>';
                    
                   while($row=mysqli_fetch_array($result))
                   {
                          echo $i.".";
                          echo $row[0];
                          echo "<input class=edit type='submit' name=$i src='edit.jpeg' alt='image' width=40 height=40 value=Edit align=justify >";
                          echo " <input class=delete  type='submit' name=$i src='delete.jpeg' alt='image' width=35 height=35 value=Delete  align=right>";
                          echo "<br><input type=radio name=$i  value=true>True.
                          <input type=radio name=$i value=false>False<br>";
                          $i++;
                   }
                
                   echo "<input type=hidden name= categoryid value=$categoryid />";
                  echo "<input type=hidden name= quizid value=$quizid />";
                    echo "<input type= hidden name=quizid1  value= $quizid />";
                     echo '</form>';
               
              if (!empty($_GET['addquestion']))
              {
                 
                // header("Location:addquestion.php?categoryid=$categoryid&quizid=$quizid");
                 print("<script>location.href='addquestion.php?categoryid=$categoryid&quizid=$quizid' </script>");
                  
                  
              }
                     
                     
              foreach($_GET as $i=> $val)
               { 
               if ($val=='Delete')
               {   echo $i;
                  $query="DELETE FROM questions WHERE questionnumber='$i' AND categoryid='$categoryid' AND quizid='$quizid'";
                  mysqli_query($con,$query);
                  echo $query;
                  $query2="UPDATE  questions SET questionnumber=questionnumber-1 WHERE categoryid='$categoryid' AND quizid='$quizid' AND questionnumber > $i";
                  mysqli_query($con,$query2);
                  
              print("<script>location.href='editquiz1.php?categoryid=$categoryid&quizid=$quizid'  </script>");
               }
               elseif($val=='Edit')
               {
                   echo $i;
               print("<script>location.href='editquiz2.php?categoryid=$categoryid&quizid=$quizid&questionnumber=$i'  </script>");
               }
              } 
               
      ?>
                
<html>
    <head>
        <style>
            .delete {
    border: 0px;
    color:crimson;
   
   
}
  .edit,.newquestion {
    border: 0px;
    color:green;
    
  }
   
input
{
    margin:10px;
}
form
{
    padding:10px;
}


        </style>
    </head>
    
    <body>
        
    </body>
</html>             
 
<?php
include('footer.php');

}
else
{
    header("Location:login.php?loginfirst");
}

?>