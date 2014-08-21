   



   <?php
                session_start();
           include('header.php');
       
           if(!empty($_SESSION['username'])){

           $con=mysqli_connect('localhost','root','nirmala12','quiz');
            $categoryid= $_GET['id'];
            echo $categoryid;
           $sql="SELECT categoryname FROM category WHERE categoryid='$categoryid'";
           $result=mysqli_query($con,$sql);
           while($data=mysqli_fetch_array($result)){
          $categoryname=$data[0];
           }
          echo $categoryname;
         
        
   ?>
            
<html>
    <head>
        <style>
          .nvi
           {
               border: solid black 1px;
            padding-left:50px;
               margin-right: 10px;
              
           }
            
           .maintable
           {
         
           }
        </style>
    </head>
    <body>
     <div> 
        <table class="maintable">
          <tr>
             <td class="nvi" >
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
             <td class="nvi" rowspan="2">
                    <?php
                    echo "<b>category selected :</b>";
                        echo $categoryname;echo'<br/>';
                    $query="SELECT quizname,quizid FROM quizzes WHERE categoryname='$categoryname'";
                    $result=mysqli_query($con,$query);
                    $found=mysqli_num_rows($result);
                    echo '<b>Select quiz </b><br/>';
                    while ($row = mysqli_fetch_array($result))
                     { $var=$row[1];
                       $quizname=$row[0];
                       echo "<a href=quizstart.php?categoryid=$categoryid&quizid=$var>$row[0] </a><br/>";
                     }
                     if($found==null)
                     {
                         echo '<br/> <b style=color:red;>There is no quiz for the selected category<b>';
                     }
                    ?>
                    
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
                    <a href="addcategory.php"<?php if($role=='student'){ echo 'style=display:none';}?> >Add category </a> 
                    </li>
                    <li>
                    <a href="deletecategory.php"<?php if($role=='student'){ echo 'style=display:none';}?>>Delete category </a>
                    </li>
                  </ul>
                  </li>
                   <li> 
                    <h4> edit quizzes </h4>
                   <ul>
                     <li>
                         <a href="addquiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >Add quiz </a>
                     </li> 
                     <li>
                         <a href="deletequiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >delete quiz</a>
                     </li>
                     <li>
                         <a href="editquiz.php"<?php if($role=='student'){ echo 'style=display:none';}?> >edit a quiz </a>
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
</body>
</html>
             
      
      
  <?php 
 
           include('footer.php');}
 else 
     {
 
    header("Location:login.php?loginfirst");  
  }
 
?>