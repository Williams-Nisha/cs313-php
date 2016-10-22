<?php

echo $_SERVER['DOCUMENT_ROOT'];

$site_root = $_SERVER['DOCUMENT_ROOT'];
include $site_root . '/db_connection.php';


if (isset($_POST['action'])) {
    $action = $_POST['action'];
} elseif (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'go_home';
}
echo "almost to case statement";
switch ($action) {
        echo "case1";
    case 'go_home':
        echo "case2";
        include $site_root . '/appointment_app.html';
        break;
    case 'go_about':
        include $site_root . '/about_me.html';
        break;
    case 'go_assignments':
        include $site_root . '/assignments.html';
        break;
    case 'go_new_patient':
        include $site_root . '/new_patient.html';
        break;
    case 'go_patient_list':
            case 'go_assignments':
        include $site_root . '/patient_list.html';
        break;
    case 'go_doctor_list':
        include $site_root . '/doctor_list.php';
        break;
    case 'go_schedule':
        include $site_root . '/schedule.php';
        break;
    case 'go_appointment':
        include $site_root . '/appointment.php';
        break;
}
//    case 'patientform':
//        //echo 'hello';
//        $userID = filter_input(INPUT_POST, 'user_id',FILTER_SANITIZE_NUMBER_INT);
//        $firstName = filter_input(INPUT_POST, 'f_name'); //returns correctly
//        $lastName = filter_input(INPUT_POST, 'l_name');
//        $email = filter_input(INPUT_POST, 'user_email');
//        $user_pass = filter_input(INPUT_POST, 'user_pass');
//        $username = filter_input(INPUT_POST, 'user_name');
//        $userLevel = filter_input(INPUT_POST, 'user_level');
//        //echo 'hello1';
//        $result = updateUsers($userID, $firstName, $lastName, $email, $user_pass, $username, $userLevel);
//
//        if ($result == FALSE) {
//            echo 'Update FAILED!!!';
//        } elseif ($result == TRUE) {
//            echo 'Update SUCCESSFUL!!!';
//            $_SESSION['editUserInfo'] = null;
//        } else {
//            echo 'Unknown Error!!!';
//        }
//        include $site_root . '/admin-tools.php';
//        break;
//
//    case 'Delete User':
//        $userID = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
//
//        if (empty($userID)) {
//            echo 'User ID is required.';
//        }
//        $result = deleteUser($userID);
//        include $site_root . '/admin-tools.php';
//        break;
//
//    case 'search_library':
//        // get the data from the form
//        $name = filter_input(INPUT_POST, 'name');
//        $subject = filter_input(INPUT_POST, 'subject');
//        //get books from library database
//        $books = getBook($subject, $name);
//
//        if (count($books) == 0) {
//            $books = getBookByCategory($subject);
//        }
//        include $site_root . '/library.php';
//        break;
//
//
//    case 'Login1':
//        $username = trim(filter_input(INPUT_POST, 'username'));
//        $passwd = filter_input(INPUT_POST, 'password');
//        $user_info = get_user_info($username);
//        if ($user_info['user_level'] != 1) {
//            $message = 'Sorry, you are not authorized to edit users.';
//        } elseif (!$user_info) {
//            $message = 'Sorry there was an error';
//        } else {
//            if ($username == $user_info['user_name'] && $passwd == $user_info['user_pass']) {
//                $_SESSION['user_info'] = $user_info;
//                $_SESSION['logged_in'] = true;
//            } else {
//                $message = 'Sorry your username or password is incorrect.';
//                $_SESSION['logged_in'] = false;
//            }
//        }
//        include $site_root . '/admin-tools.php';
//        break;
//    case 'Log Out':
//        $_SESSION['user_info'] = null;
//        session_destroy();
//        $_SESSION['logged_in'] = false;
//        echo 'You have been logged out.';
//        include $site_root . '/forums.php';
//        break;
//    case 'add_new_post':
//
//        $content = filter_input(INPUT_POST, 'content');
//        $new_post = add_new_post($userID, $content);
//        if (!$new_post) {
//            $message = 'Sorry there was an error';
//        } else {
//            $message = 'Post successfully added.';
//        }
//        include $site_root . '/forums.php';
//        break;
//    case 'Update Post':
//        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
//        $postID = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
//        $success = update_post($postID, $content);
//
//        if (!$success) {
//            echo 'Update content FAILED!';
//        } else {
//            echo 'Update content SUCCESSFUL!';
//        }
//        include $site_root . '/forums.php';
//        break;
//    case 'Delete Post':
//        $content = filter_input(INPUT_POST, 'content');
//        $postID = filter_input(INPUT_POST, 'post_id');
//        $success = delete_post($postID, $content);
//        if ($success) {
//            $message = 'You have sucessfully deleted your post.';
//        } else {
//            $message = 'Deleting the post Failed!';
//        }
//        include $site_root . '/forums.php';
//        break;
//    case 'Get User Info':
//
//        $userID = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
//
//        if (empty($userID)) {
//            echo 'User ID is required.';
//            break;
//        } else {
//            //echo 'I keep going';
//            $_SESSION['editUserInfo'] = getUserInfo($userID); //not sure about this one???
//            //$result = getUserInfo($userID);
//        }
//        include $site_root . '/admin-tools.php';
//        break;
    
    ?>    

<!--
    <html>
     <head>
        <title>
            Appointment Setter App
        </title>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="../stylesheets/styles.css">
    </head>
    <body>

        <main class="content">
-->

<!--
        <form action="<?php 
//echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>" method="POST">
            <h2>Mountainland Family Medicine</h2>
         
        </form>
-->
<!--
    </main>    
    </body>
</html>-->
