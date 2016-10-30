<?php
require('db_connection.php');
error_reporting(E_ALL);
ini_set('display_errors', true);
?>
        <?php 
            if(isset($_POST['Submit'])){
                if($count == 1){
                    $_SESSION['loggedin'] = true;
                    $_SESSION["id"] = $row['id'];

                    header("Location: /?action=account");
                }
                else{
                    echo "<span class='error'>Wrong Username or Password</span>";
                }
            }
        ?>
<html>
     <head>
        <title>
            Appointment Setter App
        </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="../stylesheets/styles.css">
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
            
        <main class="content">
          <div class="app">
           <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/app_links.php'; ?>
              <h2 class="center">Mountainland Family Medicine</h2>
              <h4 class="center">Appointment Setting Application</h4>
              <div class="preview">
                  <img class="expand" src="images/medoffice.jpg" alt="Mountainland Family Medicine">    
            </div>
            <form name="login" id="login-form" method="post" action="#">
            <table id="login">
                <tr>
                    <td>Username &nbsp;</td>
                    <td><input name="myusername" type="text" id="myusername"/></td>                                     
                    <td></td>
                </tr>
                <tr>
                    <td>Password &nbsp;</td>
                    <td><input name="mypassword" type="password" id="mypassword"/></td>  
                    <td></td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                    <td><input type="submit" name="Submit" value="Login"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                    <td colspan="3">Don't have an account? <a href="/signup.php">Sign Up</a></td>
                </tr>
            </table>
        </form>
            </div>
        </main>
    </body>
</html>