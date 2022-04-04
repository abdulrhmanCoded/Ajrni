<?php
include "config.php";
session_start();
if(isset($_POST["login"])){
  header('location:login.php');	
}
mysqli_close($link);


?>

<!DOCTYPE html5>
<html lang="en">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    
    
    
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
* {
  box-sizing: border-box;
}

  


/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */

</style>
</head>
<body>



<?php
include "header.php";
?>
<section>
 
 
<nav>
    <span class="s1">قائمة الأقسام</span><hr>
    <ul>
      <li><a class="sidebar" href="#">سيارات السيدان</a></li><hr>
      <li><a class="sidebar" href="#">سيارات الكروسؤفر</a></li><hr>
      <li><a class="sidebar" href="#">سيارات البك أب</a></li><hr>
      <li><a class="sidebar" href="#">سيارات suv</a></li><hr>
    </ul>
  </nav>
  
  <article>
    
  </article>
</section>

<footer>
  <?php
include "footer.php";
  ?>
</footer>

</body>
</html>

