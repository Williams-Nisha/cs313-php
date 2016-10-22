<?php
require('db_connection.php');
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
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
        </header>
        <main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/app_links.php'; ?>
        <?php
        $echo 'Hello from doctor list';
        ?>
        </main>
    </body>
</html>
<!--
    <select name="doctor">
        <option value="all">All Doctors</option> 
             <h2>Doctor Information</h2>
-->
             <?php
//                $query = $db->query('SELECT * FROM physician')->fetchAll();
//                
//                if($_SERVER["REQUEST_METHOD"] == "POST"){
//                    $doctor = $_POST['doctor'];
//                    if($doctor != 'all'){
//                        $query = $db->query("SELECT * FROM physician WHERE first_name='$doctor'")->fetchAll();
//                    }
//                }
//
//                foreach($db->query('SELECT DISTINCT first_name FROM physician')->fetchAll() as $doctor){
//                    if($_SERVER["REQUEST_METHOD"] == "POST"){
//                        if($_POST["doctor"] == $doctor["first_name"]){ 
//                            $selected = "selected='selected'";
//                        }
//                        else{
//                            $selected = "";
//                        }
//                    }
//                    echo '<option value="' . $doctor['first_name'] . '"' . $selected . '>' . $doctor['first_name'] . '</option>';
//                }
                ?>       
<!--
                <input type="submit" value="Search"/>
        </select>
                   
          <div class="information">
            <table>
                <thead>
                    <tr>
                        <th></th> 
                        <th>First Name</th> 
                        <th>Last Name</th> 
                        <th>Phone #</th> 
                        <th>Specialty</th>
                    </tr>
                </thead>
                <tbody>
-->
                <?php
//                    foreach($query as $row){
//                        echo '<tr>';
//                        echo '<strong><td>' . $row['physician_id'] . '</td><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['phone_number'] . '</td><td>' . $row['specialty_id'];
//                        echo '</td></tr>';
//                     }
                    ?>
<!--
                </tbody>
            </table>
        </div>
        <div id="scriptures">
-->
            <?php 
//            include('index.php');
            ?>
<!--         </div>-->