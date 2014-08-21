
<?php
session_start();
include('header.php');
$con=mysqli_connect("localhost","root","nirmala12","quiz");


if(isset($_POST['submit']))
{
 $username=$_POST['username'];
 $name=$_POST['name'];
 $email=$_POST['email'];
 $passworda=$_POST['passworda'];
 $passwordb=$_POST['passwordb'];
 if ($passworda!==$passwordb)
 {
 echo 'password dont match re-enter your password';
 }
    
    
 else 
     
 {
     
  

  $sql="INSERT INTO users(username,name,email, password)VALUES('$username','$name','$email','$passworda')";
  if(mysqli_query($con,$sql))
  {
   echo 'you are successfully registerd with us';
   
   
   
   //match username with the role and set flag for student teacher and admin{}to be done
 $_SESSION['username']=$username;
   $_SESSION['role']='student';
   $sqll="SELECT id FROM users WHERE username='$username'";
 $result=mysqli_query($con,$sqll);
 $row=mysqli_fetch_array($result);
 $userid=$row['id'];
 $sqll="INSERT INTO role(username,userid,role)VALUES('$username','$userid','student')";
 mysqli_query($con,$sqll);
 
   
   
   print("<script>location.href='home.php'</script>");
    
 }
  
 else{
     echo 'cant register enter a unique user name ';
 } 
 
 
 
 
 
 
 
    
}


}



?>

<head>  
        <style> 
            input{
                margin:10px;
            }
            label{
                margin:10px;
                 width:200px;
                 float:left;
                 }
              #f2
              {
                background-image:url(p2.jpg);
                height:100%;
              }
        
        </style>  

     
    </head>





 
<html>
   <body>
     <form action ="signup.php" method="POST" enctype="multipart/form-data" id =f2>
         <label>Full Name:</label><input type=" text" name="name" required/><br/>
         <label>Username: </label><input type=" text"name ="username" required /><br/>
         <label>Email: </label><input type="email" name="email" required /><br/>
         <label> Password:</label><input type="password" name="passworda" required /><br/>
         <label> Re-enter Password:</label><input type="password" name="passwordb" required /><br/>
         <br/> 
          <input type="submit" name= "submit" value="Create account"/>

    
     </form>
    </body>
   </html>
   
   
   <?php
   include('footer.php');
   ?>