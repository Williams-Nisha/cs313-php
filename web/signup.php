<html>
<head>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
</head>
<body>
    <h1>Sign Up</h1>
    <main>
        <?php 
            if (isset($_POST['myusername'])){ $myuser = filter_input(INPUT_POST, 'myusername', FILTER_SANITIZE_STRING); }
            else{ $myuser = ""; }
            
            if (isset($_POST['mypassword'])){ $mypass = filter_input(INPUT_POST, 'mypassword', FILTER_SANITIZE_STRING); }
            else{ $mypass = "" ;}

            if (isset($_POST['mypassword-confirm'])){ $mypassConfirm = filter_input(INPUT_POST, 'mypassword-confirm', FILTER_SANITIZE_STRING); }
            else{ $mypassConfirm = "" ;}
            
            if(isset($_POST['Submit'])){
                $error = register($myuser, $mypass, $mypassConfirm);
                if ($error == ""){
                    //$user = get_login_user();
                    //$_SESSION['loggedin'] = true;
                    //$_SESSION["username"] = $user['username'];
                    //$_SESSION["id"] = $user['id'];
                    header("Location: /teamReadiness/week7/?action=signIn");
                }
                else{
                    if($error == "Passwords don't match. Try Again."){
                        $errorMatch = "* ";
                    }
                    else{
                        $errorMatch = "";
                    }
                    echo "<span class='error'>$error</span>";
                }
            }
        ?>
        <form name="register" id="register" method="post" action="#">
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td>Username</td>
                                <td><input name="myusername" type="text" id="reg-username" value="<?php echo $myuser;?>"/></td>               
                                <td><span id="reg-username-error" class="errors"></span></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input name="mypassword" type="password" id="reg-password" value="<?php echo $mypass;?>" onblur="validationPassword('reg-password')"/></td>       
                                <td><span class='error notMatch'><?= $errorMatch ?></span><span id="reg-password-error" class="errors"></span></td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td><input name="mypassword-confirm" type="password" id="reg-password-confirm" value="<?php echo $mypassConfirm;?>" onblur="confirmPassword('reg-password-confirm', 'reg-password')"/></td>       
                                <td><span class='error notMatch'><?= $errorMatch ?></span><span id="reg-password-confirm-error" class="errors"></span></td>
                            </tr>
                            <tr><td colspan="3">&nbsp;</td></tr>
                            <tr>
                                <td><input type="submit" name="Submit" value="Sign Up" onClick="validationSubmit(event, 'register');"/></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <br/>
    </main>
</body>
</html>

<script>
    function validationSubmit(e, id){
        console.log($('#' + id + ' .errors').text().length);
        if($('#' + id + ' .errors').text().length){
            e.preventDefault();
            return false;
        }
    }
    function validationPassword(id){
        var is_password = $('#' + id).val();
        var pattern = /^.*(?=.{7,})(?=.*\d)(?=.*[a-z]).*$/;
        if(!pattern.test(is_password) && is_password.length !== 0){

            $('#' + id + '-error').show().text("Must be at least 7 characters and contain a number.");
        }
        else if(is_password.length === 0){
            $('#' + id + '-error').show().text("Must not be empty!");
        }
        else{
            $('#' + id + '-error').hide().text("");
        }
    }

    function confirmPassword(id, pass){
        var password = $('#' + pass).val();
        var confirmPass = $('#' + id).val();
        console.log(password + "" + confirmPass);
        if(password != confirmPass){
             $('#' + id + '-error').text("Passwords don't match. Try Again.");
             $('.notMatch').text("* ");
        }
        else{
            $('#' + id + '-error').text("");
            $('.notMatch').text("");
        }
    }
</script>