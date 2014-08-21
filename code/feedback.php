<?php
session_start();
include('header.php');

if (isset($_SESSION['username']))
{

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
           
           input,label
           {
            margin:30px;
           }
           
           
        </style>
           
    </head>


<h2>Feedback Form</h2>
<?php
// display form if user has not clicked submit
if (!isset($_POST["submit"])) {
  ?>
  <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
  From: <input type="text" name="from"><br>
  Subject: <input type="text" name="subject"><br>
  Message: <textarea rows="10" cols="40" name="message"></textarea><br>
  <input type="submit" name="submit" value="Submit Feedback">
  </form>
  <?php
} else {    // the user has submitted the form
  // Check if the "from" input field is filled out
  if (isset($_POST["from"])) {
    $from = $_POST["from"]; // sender
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    // message lines should not exceed 70 characters (PHP rule), so wrap it
    $message = wordwrap($message, 70);
    // send mail
    mail("nirmala@vidyamantra.com",$subject,$message,"From: $from\n");
    echo "Thank you for sending us feedback";
  }
}

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
include('footer.php');
}
else
{
  header('Location:login.php?loginfirst');  
}
                  

 ?>                 
                  
         