<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
$con= mysqli_connect('localhost','root','nirmala12','quiz');
if($con)
{
}


else {
echo 'connection failed';
}
if(isset($_POST['submit']))
{  
    $categoryname=$_POST['category'];
   // print_r($_POST);
    //exit;
    $sql= "INSERT INTO category(categoryname) VALUES('$categoryname')";
   

    
   if(mysqli_query($con,$sql))
   {
       echo 'data inserted';
      
        printf("<script>location.href='categoryadded.php?category=$categoryname'</script>");
       
       
       
       
       
       
       
   }
   else {
   echo '<b style=color:red ;align:right;>Category Name already exist , Seleect a unique name</b>';    
   }    
     
}


?> 

<html>
    <head>
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
            margin:30px;
           }
           form{
              
           }
        </style>
    </head>
    
    <table class="maintable" ><tr><td class="nvi">
                    
                    
                    
                    <?php
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
                   ?>    
    
                 
                    
                   
                    
                
                
                
                </td>
                <td class="nvi" rowspan="2"> 
                    <form action="addcategory.php" method="POST" target="_blank" align="right">
                   <label>Enter category name :</label><input type ="text" name="category" align="top"  required/><br/>
                    <input type="submit" name="submit" value="add Category" align="right"/>




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
        </div>
            
         </td>
        </tr>
        </table>
    
   
    </div>
</html>
<?php include('footer.php');  }


else
{
     header("Location: login.php?loginfirst");
}
?>