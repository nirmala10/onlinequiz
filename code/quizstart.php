     <?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
 $con=mysqli_connect('localhost','root','nirmala12','quiz');
$categoryid=$_GET['categoryid'];
$quizid=$_GET['quizid'];
//echo 'Category Selected  : <b>' .$categoryid.'</b></br>';
//echo 'quiz Selected  :<b>'.$quizid.'</b></br>';
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
        </style>
           
    </head>

    <div> 
        <table class="maintable">
            <tr>
                
                <td class="nvi">
                  <?php
                  $sql="SELECT DISTINCT categoryid ,categoryname FROM category";
   
   $result= mysqli_query($con,$sql);
   echo '<label> quiz categories</label>';
   echo '<ul>';
     $i=0;
      while($data=mysqli_fetch_array($result))
     {// echo $data[0];
        
//$category[$i]=$data[0]?>
       <li><a href=clickedcategory.php?id=<?php  echo ($data[0]);?>><?php echo "$data[1]"; ?></a></li>
         
      <?php  
     }
    echo '</ul>';
   ?>          
                </td>
                <td rowspan =2 width="400" class="nvi">
                 <img src="../quiz_1.png" width="150" height="100" />
                   <h5>Instruction</h5>
                      <ul>
                          <li>
                
                         </li>
                         <li>
                
                       </li>
                        <li>
                
                       </li>
                     </ul>
                                <form action=new.php method="GET" name="a">
                               <input type="submit" name="submit" value="start" />
                               <input type="hidden" name= categoryid value=<?php echo $categoryid;  ?> />
                              <input type= "hidden"name=quizid value=<?php echo $quizid;  ?> />
                              </form>
            
            
     
                   
            
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
                    <a href="deletecategory.php"<?php if($role=='student'){ echo 'style=display:none';}?> >Delete category </a>
                    
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
                         <a href="editquiz.php" <?php if($role=='student'){ echo 'style=display:none';}?> >edit a quiz </a>
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
   header('Location:login.php?loginfirst');  
}

?>







