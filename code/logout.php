<?php
session_start();
include('header.php');
$con=mysqli_connect('localhost','root','nirmala12','quiz');




$query1="UPDATE role SET role='admin'WHERE userid=1";
     
     mysqli_query($con,$query1);
     
     setcookie('username');
     

session_destroy();
print_r($_SESSION);
header("Location: login.php");
//print_r($_COOKIE);
//printf("<script>location.href='login.php'</script>");








?>          
