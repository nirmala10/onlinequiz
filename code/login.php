




<?php
session_start();

    
include('header.php');
if(isset($_GET['loginfirst']))
{
  echo '<b style="color:red;">Log in or singn up with us </b>';
}

$con=mysqli_connect("localhost","root","nirmala12","quiz");
  
if(isset($_POST['submit']))
    
{
    
 $username=$_POST['username'];
 $password=$_POST['password'];
 $sql="SELECT id FROM users WHERE username='$username' AND password='$password'";

 
 $result=mysqli_query($con,$sql);
 

 if($data=mysqli_fetch_row($result))
 {
 echo $data[0];
 $found= mysqli_num_rows($result);
      if ($found)
          {
                 $_SESSION['username']=$username;
 
                 print("<script>location.href='home.php'</script>");
         
                $query ="SELECT role FROM role  WHERE username='$username'";
                $result=mysqli_query($con,$query);
                while($row=mysqli_fetch_array($result))
                {
                    $role=$row[0];
                }
              $_SESSION['role']=$role;
           
           //echo $_SESSION['role'];
           

           
          }
    else 
       {
 
     echo'You need to register with us';
       }
 }
 else
     echo 'You need  register with us first';
 
}



 else{
?>
<html>
    <head> 
        <style>
        input{
 margin:20px;
 
 
}
label{
    margin:20px;
    
    width:100px;
   float:left;
  
}
      </style>  
    </head>


    <form action ="login.php" method="POST" >
    <label>Username </label>:<input type="text" name="username" /> <br/>
    <label> Password </label>:<input type="password" name="password" /><br/>
    <input type="submit" name="submit" value="submit"/>
    </form>
</html>

<?php
 include('footer.php');}
?>