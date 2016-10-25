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
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/header.php'; ?>
        <main class="content">
              <div class="app">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/modules/app_links.php'; ?>
                <div class="information">
                  <h4>Doctor List</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                   <select name="doctor">
        <option value="all">All Patients</option> 
             <h2>Appointment Information</h2>
             <?php
                $query = $db->query('SELECT * FROM patient')->fetchAll();
                
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $patient = $_POST['patient'];
                    if($patient != 'all'){
                        $query = $db->query("SELECT * FROM patient WHERE first_name='$patient'")->fetchAll();
                    }
                }

                foreach($db->query('SELECT DISTINCT first_name FROM patient')->fetchAll() as $doctor){
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($_POST["patient"] == $patient["first_name"]){ 
                            $selected = "selected='selected'";
                        }
                        else{
                            $selected = "";
                        }
                    }
                    echo '<option value="' . $patient['first_name'] . '"' . $selected . '>' . $doctor['first_name'] . '</option>';
                }
                ?>       
                <input type="submit" value="Search"/>
        </select>
            </form>
            <table>
                <thead>
                    <tr>
                        <th></th> 
                        <th>First Name</th> 
                        <th>Last Name</th> 
                        <th>Date</th> 
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Doctor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($query as $rows){
                        echo '<tr>';
                        echo '<td></td>' . $rows['first_name'] . '</td><td>' . $rows['last_name'] . '</td><td>' . $rows['appointment_date']. '</td><td>' . $rows['appointment_date'] . '</td><td>' . $rows['appointment_date']. '</td><td>' . $rows['physician_id'];
                      echo '</td></tr>';
                     }
                    ?>
                </tbody>
            </table>
                </div>
              </div>
        <?php
            echo 'Hello from appointment page';
        ?>
        </main>
    </body>
</html>