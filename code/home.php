<?php
session_start();
include('header.php');
 $con=mysqli_connect('localhost','root','nirmala12','quiz');
 if(!empty($_SESSION['username'])){

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
   
  if(isset($_REQUEST['timeout']))
  {
  echo '<b style= color:red;></br/>Your time expired,Answers not saved.........Appear again</br></b>';
  }



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
                <td class="nvi" rowspan =2>
                    <img src="../image2.jpeg"width="500" height="200"/>
                   
            
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


 }
 else {
     header("Location: login.php?loginfirst");
}

 

    

?>
