



<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
 $con=mysqli_connect('localhost','root','nirmala12','quiz');
 if(!empty($_SESSION['role'])){ $role=$_SESSION['role'];} 

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
        <table class="maintable"><tr><td class="nvi">
<?php
  
   $sql="SELECT DISTINCT categoryid ,categoryname FROM category";
   
   $result= mysqli_query($con,$sql);
   echo '<label> quiz categories</label>';
   echo '<ul>';
     $i=0;
      while($data=mysqli_fetch_array($result))
     {// echo $data[0];
        
//$category[$i]=$data[0]?>
       <li><a href=clickedcategory.php?id=<?php  echo ($data[0]);?> target="_blank"><?php echo "$data[1]"; ?></a></li>
         
      <?php  
     }
    echo '</ul>';
   ?>            
   </td>
                <td class="nvi" rowspan =2>
                    <?php
                   $user=$_GET['name'];

$query="SELECT *FROM role WHERE username='$user'";
$result=mysqli_query($con,$query);
echo '<form action=search.php method=GET>';
  echo '<table><tr><td>';
while($row=mysqli_fetch_array($result))
        
{ 
    echo 'name';
    echo '</td><td>';
echo 'userid';
echo '</td><td>';
echo 'role <br/>';
echo '</td></tr><tr><td>';
  echo $row[1];
  echo '</td><td>';
  echo $row[2];
echo '</td><td>';
//echo $role;
$role1= $row[3];
echo $role1;?>
<br/>Admin:<input type=radio name=person value=admin <?php if(($row['role']=="admin")){echo 'checked="checked"';} ?> />
    Teacher:<input type=radio name=person value=teacher <?php if(($row['role']=="teacher")){echo 'checked="checked"';} ?>/>
    Student:<input type=radio name=person value=student <?php if(($row['role']=="student")){echo 'checked="checked"';} ?>/>

  </td><td></tr>';

<?php } 
      echo '</table>'; 
      echo "<input type= hidden name=name value=$user>";
      echo '<input type= submit name=submit1 value="Change role"/>';
      
      echo '</form>';
      if(isset($_GET['submit1']))
     {
          $newrole=$_GET['person'];
     $query1="UPDATE role SET role='$newrole'WHERE username='$user'";
     
     mysqli_query($con,$query1);
        if ($newrole=='teacher')
        {
            $query2="UPDATE role SET role='student' WHERE role='teacher' AND username !='$user'";
            mysqli_query($con,$query2);
        } 
        printf("<script>location.href='role.php'</script>");
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
                    <a href="addcategory.php" <?php if(isset($_SESSION['role'])&&($role=='student')){ echo 'style=display:none';}?> >Add category </a> 
                </li>
                <li>
                    <a href="deletecategory.php"<?php if(isset($_SESSION['role'])&&($role=='student')){ echo 'style=display:none';}?>>Delete category </a>
                    
                </li>
                
                    
               
            
             </ul>
             </li>
             <li> 
                 <h4> edit quizzes </h4>
                 <ul>
                     <li>
                         <a href="addquiz.php"<?php if(isset($_SESSION['role'])&&($role=='student')){ echo 'style=display:none';}?> >Add quiz </a>
                     </li> 
                     <li>
                         <a href="deletequiz.php"<?php if(isset($_SESSION['role'])&&($role=='student')){ echo 'style=display:none';}?> >delete quiz</a>
                     </li>
                     <li>
                         <a href="editquiz.php"<?php if(isset($_SESSION['role'])&&($role=='student')){ echo 'style=display:none';}?> >edit a quiz </a>
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






