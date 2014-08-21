
<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){

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
            border:1px;
           }
           input{
               margin:20px;
           }
        </style>
           
    </head>

    <div> 
        <table class="maintable"><tr><td class="nvi">
                    
                    
                    
                    <?php
  $sql="SELECT DISTINCT categoryid ,categoryname FROM category";
                  $result= mysqli_query($con,$sql);
                   echo '<label> quiz categories</label>';
                   echo '<ul>';
                   $i=0;
                   while($data=mysqli_fetch_array($result))
                    {
                       ?>
                   <li><a href=clickedcategory.php?id=<?php echo $data[0];?> ><?php echo $data[1]; ?></a></li>
                   <?php 
               
                    }
                   echo '</ul>';
                   ?>    
    
                 
                    
                   
                    
                
                
                
                </td>
                <td class="nvi" rowspan =2>
                 
                    <form action="deletecategory.php" method="GET">
                      <label><b>Select a category to delete </b></label>
                                                 <?php
                                                 
                                                  $sql="SELECT categoryname, categoryid FROM category";
                                                 
                                                  $result=mysqli_query($con,$sql);
                                                  echo '<select name="categoryselect"required>';
                                                 //loop to select values from data base
                                                 echo  '<option value="" selected>Make a choice</option>';
                                                  
                                                     while ($data=mysqli_fetch_row($result))
                                                     { 
                                                        echo "<option name=categoryselect value=$data[1]>$data[0]</option>";
                                                      
                                                        
                                                      }
                                                 ?>
                                                 </select><br/>
                
                        <input type="submit" name="deletecategory" value="submit"/>
                    </form>
                    
               <?php
               
               if(isset($_GET['deleted'])){
                   echo 'Category deleted is :'.$_GET['deleted'].'<br>';
                   echo 'select to delete more or exit';
                   
               }
               
               if(isset($_GET['deletecategory']))
               { 
                 $selectedcategory = $_GET['categoryselect'];
                 
                 $sql1="SELECT * FROM category WHERE categoryid='$selectedcategory'";
               // echo $sql1;
                  if($result1=mysqli_query($con,$sql1))
                          
                  {
                     $sql="SELECT * FROM category WHERE categoryid=$selecetedcategory"; 
                      
                  
                          echo 'executed';
                  }
                      else 
                          
                      {
                       echo 'not executed';
                      }
                  while($row1=mysqli_fetch_array($result1))
                  {
                   //   echo 'hello';
                   $categoryid=$row1[0];
                   $categoryname=$row1['categoryname'];
                  }
                  echo $categoryid;
                  
                   $sql="DELETE FROM questions WHERE categoryid=$categoryid";
                   // echo$sql;
                   $result=mysqli_query($con,$sql);
                  
                   $sql2="DELETE FROM quizzes WHERE categoryid='$selectedcategory'";
                   //echo $sql2;
                   $result=mysqli_query($con,$sql2);
                   
                   
                   
                 
                 $sql="DELETE FROM category WHERE categoryid='$selectedcategory'";
          
                if(mysqli_query($con,$sql))
                 
                 
              
                {
                    printf("<script>location.href='deletecategory.php?deleted=$categoryname' </script>");
                   echo 'Selected category deleted........</br> ';
                   echo '<br/>Select another one or exit';
                }
                 
                   
                   
                   
                   
                   
                   
               }
               
               
               ?>
                    
                    
                    
                    
                    
                    
              </td>
            </tr>
     <tr>
         <td class="nvi">
             <div>
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
                    <a href="addcategory.php"<?php if($role=='student'){ echo 'style=display:none';}?> >Add category </a> 
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
                         <a href="previousresult.php" >Previous results </a>
                     </li>
                     <li>
                         <a href="overallperformance.php"<?php if($role=='student'||$role=='teacher'){ echo 'style=display:none';}?> > overall Performance of all students </a>
                 
             </li>
            
             
            </ul>
        </div>
            
         </td>
        </tr>
        </table>
    
   
    </div>





</html>
<?php
include('footer.php');
}
 else 
    
 {
header("Location:login.php?loginfirst");
 }

?>
