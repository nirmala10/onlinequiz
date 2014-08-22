<?php
function display_admin_task($role)
{
    echo '<h3> Administrative </h3>';
            echo '<ul>';
           
                if(isset($role))
                {
                echo "<b style=color:green;>Signed in role as :".$role."</b>";
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
                 
                 
                 
             </li>
             
             
             <li>
                         <a href="role.php"<?php if($role=='student'||$role=='teacher'){ echo 'style=display:none';}?> >edit role </a>
                     </li>
                     <li>
                         <a href="previousresult.php" > Your Previous results </a>
                     </li>
                     <li>
                         <a href="overallperformance.php"<?php if($role=='student'||$role=='teacher'){ echo 'style=display:none';}?> > overall Performance of all students </a>
                     </li>
            
             
            </ul>
    
    
<?php }

function display_categories($con)
{
  
    
 $sql="SELECT DISTINCT categoryid ,categoryname FROM category";
                  $result= mysqli_query($con,$sql);
                   echo '<label> quiz categories</label>';
                   echo '<ul>';
                   $i=0;
                   while($data=mysqli_fetch_array($result))
                    {
                       ?>
                   <li><a href=clickedcategory.php?id=<?php echo "$data[0]";?> ><?php echo $data[1]; ?></a></li>
                   <?php 
                 
                    }
                   echo '</ul>';
                  
     
    
}
?>

