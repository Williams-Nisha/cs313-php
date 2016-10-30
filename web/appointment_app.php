<?php
require('db_connection.php');
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
require 'functions.php';
?>
        <?php 
            echo 'Made it to the top';
            if(isset($_POST['Submit'])){
                //check if signe in already
                if($count == 1){
                    $_SESSION['loggedin'] = true;
                    $_SESSION["id"] = $row['id'];
                    echo "<script type=\"text/javascript\">
                            $('.login').hide();
                          </script>";
                    //account.php page//
                    if($_SESSION['loggedin']){
                        $row = get_user();
                        echo '<h1>Welcome <?= $row["username"]; ?></h1>';
                        break;

                    } else{ //CASE SIGN IN//    
                            $row = get_login_user();
                            if($row == ""){
                                $count = 0;
                            }
                            else{
                                $count = login($row);
                            }
                            break;
                    }
                    
                } else{
                    echo "<span class='error'>Wrong Username or Password</span>";
                }
            }
//            if (isset($_POST['action'])){
//                $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
//            } 
//            else if(isset($_GET['action'])){
//                $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
//            }
           
        ?>
<html>
     <head>
        <title>
            Appointment Setter App
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
      <link rel="stylesheet" href="../stylesheets/styles.css">
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
            
        <main class="content">
          <div class="app">
           <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/app_links.php'; ?>
        <div class="container">
          <div class="row">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="login col-sm-6">
                <input type="hidden" name="action" value="login">
            <table id="login">
                <tr>
                    <td>Username &nbsp;</td><span class="error">*<?= $userErr;?></span>
                    <td><input name="myusername" type="text" id="myusername"/></td>                           
                    <td></td>
                </tr>
                <tr>
                    <td>Password &nbsp;</td><span class="error">*<?= $passErr;?></span>
                    <td><input name="mypassword" type="password" id="mypassword"/></td>  
                    <td></td>
                </tr>
                <tr>
                    <td><input type="submit" name="Submit" value="Login"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">Don't have an account? <a href="/signup.php">Sign Up</a></td>
                </tr>
            </table>
              </form>
               <div class="col-sm-6 title">
                <h2 class="center">Mountainland Family Medicine</h2>
                <h4 class="center">Appointment Setting Application</h4>
               </div>
            </div>
              </div>
              <div class="preview">
                  <img class="expand" src="images/medoffice.jpg" alt="Mountainland Family Medicine">    
            </div>
            </div>
        </main>
    </body>
</html>