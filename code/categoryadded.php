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
           input,label
           {
             margin:40px;
           }
           form
           {
               margin:50px;
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
                   <li><a href=clickedcategory.php?id=<?php echo "$data[0]";?>><?php echo $data[1]; ?></a></li>
                   <?php 
                 
                    }
                   echo '</ul>';
                   ?>    
    
                   
                    
                   
                    
                
                
                
                </td>
                <td class="nvi" rowspan =2>
                   <?php 
                    if(isset($_GET['yes']))
{
    
   printf("<script>location.href='addcategory.php'</script>");
}
elseif(isset($_GET['no']))
{
     printf("<script>location.href='home.php?'</script>");
    
}










?>


<html>
    <head>
        
    </head>
    <body>
        <div>
       
        </div>
        <form method="GET" action="categoryadded.php">
            <label><b>Do you want to add more category ?</b></label><br/>
            
          <input type="hidden" name='category' value="<?php echo "$category" ?>" />
          <input type="hidden" name="quizname" value="<?php echo "$quizname"  ?>" />
        <input type="submit" name=" yes" value="yes    "/>
        <input type="submit" name=" no" value="no     "/>
        </form>
    </body>
    
    
    
</html>
            
                </td>
            </tr>
     <tr>
         <td class="nvi">
             <div>
            <h3> Administrative </h3>
            <ul>
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























