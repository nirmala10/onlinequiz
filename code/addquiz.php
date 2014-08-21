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
           input
           {
             margin:40px;
           }
        </style>
   
           
    </head>

<?php
session_start();
include('header.php');

if(!empty($_SESSION['username'])){
$con= mysqli_connect('localhost','root','nirmala12','quiz');
if (isset($_GET['submit']))
{ 
  if(!empty($_GET['categoryselect']))
     {
      
      $categoryid=$_GET['categoryselect'];
      echo '++++++++++++++';
      echo $categoryid;
      
       $query="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
           $result=mysqli_query($con,$query);
           while($row=mysqli_fetch_array($result))
           {
           $categoryname=$row[0];
           }
      
     }
  if(!empty($_GET['categoryname']))
     {
      $categoryname=$_GET['categoryname'];
  
     }
     $quizname =$_GET['quizname'];
     echo $quizname;
     $sql="SELECT * FROM quizzes WHERE quizname='$quizname' ";
     $result=mysqli_query($con,$sql);
     
    $found= mysqli_num_rows($result);
    //echo $sql;
    //echo $found;
    if($found)
    {
     echo 'quiz name already exist to edit quiz go to edit quiz';
    }
 else{
        
     while ($row = mysqli_fetch_array($result)) 
     {
        $categoryname=$row['categoryname'];
        //$quizid=$row['quizid'];
       
     }
     
     if(!empty($_GET['categoryname']))
     {
         $query="INSERT INTO category(categoryname)VALUES ('$categoryname')";
         mysqli_query($con,$query);
         
          $query="SELECT categoryid FROM category WHERE categoryname='$categoryname'";
           $result=mysqli_query($con,$query);
           while($row=mysqli_fetch_array($result))
           {
           $categoryid=$row[0];
           }
         
         
     }
     
     
     
    
   if((!empty($_GET['categoryselect']))||(!empty($_GET['categoryname'])))
   {
       
        echo '======='; 
      echo $categoryname;   
   
  
    
    $query="INSERT INTO quizzes(quizname,categoryname)VALUES ('$quizname','$categoryname')";
    echo $quizname;
    mysqli_query($con,$query);
    $sql="SELECT quizid FROM quizzes WHERE quizname='$quizname' ";
     $result=mysqli_query($con,$sql);
     while ($row = mysqli_fetch_array($result)) 
     {
        $quizid=$row['quizid'];
        //$quizid=$row['quizid'];
     
     }
     echo "**************";
      echo $quizid;
   printf("<script>location.href='addquestion.php?categoryid=$categoryid&quizid=$quizid'</script>");
   }
 else 
       
 {
   echo '<b style="color:red;">PLEASE SELECT a CATEGORY name OR Enter a category name<b>';
 }
  
    
 }
 }
?>
<html>
    <head>
        
    </head>
    <body>
        <table class='maintable'>
            <tr>
                <td class='nvi'>
                    <?php
                           $sql="SELECT DISTINCT categoryid ,categoryname FROM category";
   
   $result= mysqli_query($con,$sql);
   echo '<label> quiz categories</label>';
   echo '<ul>';
     $i=0;
      while($data=mysqli_fetch_array($result))
     {// echo $data[0];
        
//$category[$i]=$data[0]?>
       <li><a href=clickedcategory.php?id=<?php  echo ($data[0]);?> ><?php echo "$data[1]"; ?></a></li>
         
      <?php  
     }
    echo '</ul>';
   ?>                     
                    
               </td>
               <td class= nvi rowspan='2'>
                  <form action="addquiz.php" method="GET">
                      <fieldset style="margin:20px;">
                          <legend>Category of quiz</legend>
                      <label><b>Select a category for quiz </b></label>
                                                 <?php
                                                 
                                                  $sql="SELECT categoryid,categoryname FROM category";
                                                 
                                                  $result=mysqli_query($con,$sql);
                                                  echo '<select name="categoryselect">';
                                                 //loop to select values from data base
                                                 echo  '<option value="" selected name= categoryselect>Make a choice</option>';
                                                  
                                                     while ($data=mysqli_fetch_row($result))
                                                     { 
                                                        echo "<option name=categoryselect value= '".$data[0]."'>$data[1]</option>";
                                                       
                                                        
                                                      }
                                                 ?>
                                                 </select><br/>
                                        
                                                 
                                                 <label><h4>OR</h4></label><br/>
                                                 <label style="width:400px;float:left;"><b>Enter a new category for quiz </b></label><input style='margin:20px;' type="text" name="categoryname"  /> <br/>
                      </fieldset>
                      <fieldset style="margin:20px;">
                          <legend>Quiz name</legend>
                         <label style="width:400px; float:left;">Enter a quiz name</label><input style='margin:20px;' type="text" name="quizname"/><br/>
                             <input type="hidden" name=" quizid" value=<?php echo @$quizid ;?> />
                           <input type="hidden" name="categoryid" value=<?php echo @ $categoryid; ?> />
                           <
                         <input style='margin:20px;' type ="submit" name="submit" value="adddquiz"/><br/>
                         </fieldset>
                  </form>
               </td>
            </tr>
     <tr>
         <td class=' nvi'>
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

