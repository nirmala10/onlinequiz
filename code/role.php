<?php
session_start();
include('header.php');
if(!empty($_SESSION['username'])){
$con=mysqli_connect('localhost','root','nirmala12','quiz');
$query="SELECT * FROM role";
$result=mysqli_query($con,$query);
echo '<b>Assign role :    </b><br/>';
echo 'user id 1 is assigned to the admin';

echo '<form  method="GET" action="search.php"  id="searchform">' ;
	      echo 'Enter user name to change role :<input  type="text" name="name">' 	;
              echo '<input  type="submit" name="submit" value="Search">';
	    echo '</form>'; 

 echo '<b> OR </b><br/>';
  echo '<b> UPDATE ROLE IN THE TABLE</b><br/>';
echo '<form action=role.php method=GET>';
echo '<table class=maintable><tr><th class=cell>Username</th><th class= cell>Userid</th><th class= cell>Admin </th><th class= cell>Teacher</th><th class= cell>Student</th></tr>';
$i=0;
while($row=mysqli_fetch_array($result))
{   $userid[$i]=$row['userid'];
    $role[$i]=$row['role'];
    //echo $row['role'];
  // echo $i;
   //echo $userid[$i];
    
    echo '<tr><td class=nvi>';
    $username1[$i]=$row['username'];
    echo $username1[$i];
    echo '</td><td class=nvi>';
   
    echo $userid[$i];
    echo '</td><td class=nvi>';

           if($userid[$i]==1)
               {  
            
               ?>
               <input type=radio name="<?php echo $userid[$i]; ?>"value= "admin" checked <?php if(!empty($_GET[$userid[$i]])&&isset($_GET['submit'])&&$row['role']=='admin'){ echo 'checked="checked"'; } ?>  ></td><td class=nvi>
                <input type= radio name="<?php echo $userid[$i]; ?>"value="teacher"<?php if($row['role']=='teacher'){ echo 'checked' ;} ?> > </td><td class=nvi>
                <input type=radio name="<?php echo  $userid[$i];?>"value="student"  > </td></tr>
          <?php }
           else{ ?>
         <input type=radio name= "<?php echo  $userid[$i]; ?>" value="admin" disabled="disabled" > </td><td class=nvi>
           <input type= radio name="<?php echo $userid[$i]; ?>" value="teacher"<?php  if(($row['role']=="teacher")){echo 'checked="checked"';} ?>> </td><td class=nvi>
         <input type=radio name= "<?php echo $userid[$i]; ?>" value="student"<?php  if(($row['role']=="student")){ echo 'checked="checked"';} ?>  > </td></tr>
           <?php }
   $i++;        
}

echo '</table>';


echo '<input type=submit name= submit value=update >';
  echo '<input  type="submit" name="finished" value="No more update">';

echo '</form>';
if(isset($_GET['finished']))
{
    printf("<script>location.href='home.php'</script>");
}





if(isset($_GET['submit']))
{
    
    $j=0;
    // to fetch exesting user id from role if present in database then update 
    
    
   foreach($_GET as $key=> $val) 
   {
           if($val=='update')
           { echo 'break';
              break;
           }
           elseif($key=='admin')
           {
               echo 'Admin cannt be updated';
             
              
           }
           
          
           $query="UPDATE role SET role='$val' WHERE  userid='$key'";
           mysqli_query($con,$query);
           
          
         //echo $query;
         // echo $j;
           $j++;
 
   }
    printf("<script>location.href='role.php'</script>");
  
}   
   
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
           
           .cell
           {
             border:solid black 1px;
           }
           input[type=submit]{
               
      margin:100px;
           }
           
           form{
               margin-left:100px;
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
   header('Location:login.php?locginfirst');  
 }
?>


