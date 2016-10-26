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
                        $query = $db->query("SELECT * FROM patient WHERE first_name='$patient' AND patient_id")->fetchAll();
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
                        <th>Patient Name</th>  
                        <th>Date</th> 
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Doctor</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                    foreach($query as $row){
                    echo '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
                    foreach($db->query("SELECT * FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.patient_id='" . $row['patient_id'] . "'") as $appointment){
                        echo '<td>' . $appointment['appointment_date'] . "</td><td>" . $appointment['appointment_date'] . "</td><td>" . $appointment['physician_id'] ;
                    }
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