
<html>
    <style>
        th,td{
            border:solid black 0px;
        }
        #header
        {
          width:100%;
          height:130px;
          background-color:lightskyblue;
            
        }
        #rowq
        {
         align:baseline;
        }
        #table1
        {
        margin-bottom:10px;
        }
        #table2
        {
         // margin-bottom:5px;
        }
        td
        {
        padding-bottom:1px;
        padding-left: 20px;
        padding-right:90px;
        }
        #right
        {
            text-align:end;
            width:800px;
            height:30px;
        }
  
    </style>
    
</html>

<?php
echo '<div id= header>';
if(!empty($_SESSION['role']))
{ $role=$_SESSION['role'];
echo 'signed in as  <b>'.$role.'</b><br>';
}
echo 'welcome ...........';
echo '<table id=table1><tr id=rowq>';
echo '<td id= right>';

if(!empty($_SESSION['username']))
    
{  
   echo '<a href= logout.php>logout</a></td>';
  
    
}

 else
     {
   

echo '<a href= login.php>login </a></td>'
        . '<td> <a href=signup.php>register</a></td>'
        . '<td></td><td></td><td> </td></tr> '
        . '</table>';
     }


echo '<table id=table2><tr id=rowq>';
if(!empty($_SESSION['role']))
{
   
echo '<td><a href=home.php>home</a></td>';
}  

echo '<td><a href=about.php>about</a></td>'
        . '<td><a href=contact.php>contact</a></td>'
        . '<td><a href= feedback.php>feedback</a></td>'
        . '<td><a href= help.php>help</a></td>'
        . '<td> </td></tr> </table>';
echo '</div>';
?>
