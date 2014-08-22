
<?php
session_start();
include('header.php');
include('liv.php');
include('repeatedhtmlpart.php');
if(!empty($_SESSION['username']))
   {
    $con=db_connect('localhost','root','nirmala12','quiz');
    $role=$_SESSION['role'];
       if(isset($_GET['deletecategory']))
          {
           $selectedcategory = $_GET['categoryselect'];
           $categoryname= find_categoryname($con,$selectedcategory);
           echo $categoryname; 
           deletecategory($con,$selectedcategory,$categoryname);
           printf("<script>location.href='deletecategory.php?deleted=$categoryname' </script>");
           }
 ?>
                    
  <html>
    <head>
        <title>home</title>
        <link rel="stylesheet" type="text/css" href="quiz.css"/>
    </head>
    <div> 
        <table class="maintable">
              <tr>
                  <td class="nvi">
                   <?php
                    display_categories($con)
                   ?>
                  </td>
                  <td class="nvi" rowspan =2>
                  <form action="deletecategory.php" method="GET">
                      
                            <?php if(isset($_GET['deleted']))
                                {
                                  echo '</br>Category deleted is :'.$_GET['deleted'].'</br>';
                                  echo '</br> Select another one to delete  or exit</br>';
                                }
                                  echo '<label></br><b>Select a category to delete </b></label>';
                                  $sql="SELECT categoryname, categoryid FROM category";
                                 $result=mysqli_query($con,$sql);
                                  echo '<select name="categoryselect"required>';
                                  //loop to select values from data base
                                  echo  '<option value="" selected>Make a choice</option>';
                                  while ($data=mysqli_fetch_row($result))
                                    { 
                                    echo "<option name=categoryselect value=$data[1]>$data[0]</option>";
                                    }
                                   ?>
                                   </select><br/>
                     
                        <input type="submit" name="deletecategory" value="submit"/>
                   </form>
                   </td>
              </tr>
              <tr>
                  <td class="nvi">
                  <div>
                  <?php display_admin_task($role) ?>
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
