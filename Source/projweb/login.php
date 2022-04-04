<?php
include "config.php";
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 

 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            header("location: index.php");
                        } else{
                            $login_err = "خطاء في اسم المستخدم او كلمة المرور.";
                        }
                    }
                } else{
                    $login_err = "خطاء اسم المسخدم مكتوب بطريقة غير صحيحه.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Main Css style file-->
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Login</title>
    
    <style>
        body{ font: 18px sans-serif; }
        .wrapper { width: 600px;  margin: 0 auto; }
    </style>
</head>
<body>







<?php
include "header.php";
?>

 <br>

 <section>
 <div class="wrapper  ">
  
        
  <div class="container-fluid login  ">
  <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
<input type="checkbox" class="btn-check" id="btncheck1" checked="" autocomplete="off">
<label class="btn btn-primary" for="btncheck1">عميل</label>
<input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
<label class="btn btn-primary" for="btncheck2">شركة</label>

</div>

      <h2 >تسجيل الدخول</h2>
      <p>يرجى ملء بيانات حسابك الخاصة بك لتسجيل الدخول.

.</p>


      <?php 
      if(!empty($login_err)){
          echo '<div class="alert alert-danger">' . $login_err . '</div>';
      }        
      ?>

      <form action="" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
          <div class="">
              <label>اسم المستخدم</label>
              <input type="text" name="username" class="form-control pull-center <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
              <span class="invalid-feedback"><?php echo $username_err; ?></span>
                              <label>كلمة المرور</label>
              <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
              <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>    
           <div class="form-group">
              <input type="submit" class="btn btn-primary" value="دخول">
              <a class="btn btn-secondary ml-2" href="reset-password.php">نسيت كلمة المرور</a>
          </div>
          <p>ليس لديك حساب؟ <a href="register.php">اشترك الآن .</a>.</p>
      </form>
  </div>
 </section>

 
    
</body>
</html>