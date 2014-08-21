
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
               margin:50px;
           }
        </style>
           
    </head>

    <div> 
        <table class="maintable"><tr><td class="nvi">
                    
                    
                    
                    <?php
  
   $sql="SELECT DISTINCT categoryid, categoryname FROM category";
  
   $result= mysqli_query($con,$sql);
  
 
     echo '<label> quiz categories</label>';
     echo '<ul>';
     $i=0;
      while($data=mysqli_fetch_array($result))
     { //$category[$i]=$data[0]?>
       <li><a href=clickedcategory.php?id=<?php echo $data[0];?>><?php echo $data[1]; ?></a></li>
         
      <?php 
     }
    echo '</ul>';
    
        ?>            
                    
                   
                    
                
                
                
                </td>
                <td class="nvi" rowspan =2>
                   
                    
                    <form action="deletequiz.php" method="GET">
                    
                                                 <?php
                                                  if(empty($_GET['categoryselected'])){
                                                        echo '<label><b>Select  category Of the quiz :</b></label>';
                                                  $sql="SELECT categoryname ,categoryid FROM category";
                                                 
                                                  $result=mysqli_query($con,$sql);
                                                  echo '<select name="categoryselect">';
                                                 //loop to select values from data base
                                                 echo  '<option value="" selected>Make a choice</option>';
                                                  
                                                     while ($data=mysqli_fetch_row($result))
                                                     { 
                                                        echo "<option name=categoryselect value=$data[1]>$data[0]</option>";
                                                       
                                                        
                                                      }
                                                      echo '<br/>';
                                                 ?>
          
                      
                 </select><br/>
               
                 <input type="submit" name="categoryselected" value="Now select a quiz  name"/>
                
               
                                                 <?php
                                                }
                                                 if (!empty($_GET['categoryselected']))
                                                { 
                                                     
                                                  $categoryid= $_GET['categoryselect'];
                                                     $sql="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
                                                       $result=mysqli_query($con,$sql);
                                                     while($data=mysqli_fetch_array($result)){
                                                 $categoryname=$data[0];
                                                    }
                                                  echo $categoryname;
                                                     echo 'Your selected Category :';
                                                  echo '<b>'.$categoryname.'<b><br/>';
                                                 
                                                  $sql="SELECT quizname,quizid FROM quizzes WHERE categoryname='$categoryname'";
                                                 
                                                  $result=mysqli_query($con,$sql);
                                                  $found=mysqli_num_rows($result);
                                                  if($found==0)
                                                  {
                                                      echo '<b Style=color:red;><br/>there is no quiz for the selected category </b>';
                                                  }
                                                  
                                                  
                                                  else
                                                  {
                                                       echo '<br/><label><b>Select a quiz to delete </b></label>';
                                                  echo '<select name="quizselect">';
                                                 //loop to select values from data base
                                                 echo  '<option value="" selected>Make a choice</option>';
                                                  
                                                     while ($data=mysqli_fetch_row($result))
                                                     { 
                                                        echo "<option name=quizselect value=$data[1]>$data[0]</option>";
                                                       
                                                        
                                                      }
                                                    
                                                    echo '<br>';
                                                     echo "<input type='hidden' name='categoryid' value= $categoryid />";
                                                   echo  '<input type="submit" name="deletequiz" value="submit"/>';
                   
                                               }   
                                                }
                                               else {
     
                                                    }
                                                      
                                                 ?>
                         
                    
                    
                    </form>
                    
               <?php
               if(isset($_GET['deletequiz']))
                  { $categoryid=$_GET['categoryid'];
                 // echo $categoryname;
                     // $selectedcategory = $_GET['categoryselect'];
                     $selectedquiz=$_GET['quizselect'];
                     echo $selectedquiz;
                      $sql="DELETE FROM quizzes WHERE quizid='$selectedquiz'";
                      $result=mysqli_query($con,$sql);
                   
                if($result)
                {
                   echo 'Selected quiz deleted deleted........</br> ';
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
                    <a href="addcategory.php" >Add category </a> 
                </li>
                <li>
                    <a href="deletecategory.php">Delete category </a>
                    
                </li>
                
            </ul>
             </li>
             <li> 
                 <h4> edit quizzes </h4>
                 <ul>
                     <li>
                         <a href="addquiz.php" >Add quiz </a>
                     </li> 
                     <li>
                         <a href="deletequiz.php" >delete quiz</a>
                     </li>
                     <li>
                         <a href="editquiz.php" >edit a quiz </a>
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
