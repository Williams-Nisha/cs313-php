<?php
require('db_connection.php');
error_reporting(E_ALL);
ini_set('display_errors', true);
?>
<?php
   $fname = $lname = $adate = $atime = $doctor = "";
   $fnameErr = $lnameErr = $adateErr = $atimeErr = $doctorErr ="";
  
       if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'appointment_form') {
            if(empty($_POST["first_name"])){
                $fnameErr = "First name is required";
            }
            else{
                $fname = $_POST["first_name"];
            }
            if(empty($_POST["last_name"])){
                $lnameErr = "Last name is required";

            }
             if(empty($_POST["appointment_date"])){
                $adateErr = "Appointment Date is required";
            }
            else{
                $adate = $_POST["appointment_date"];
            }
            if(empty($_POST["appointment_time"])){
                $atimeErr = "Appointment start time is required";
            }
            else{
                $atime = $_POST["appointment_time"];
            }
            if(empty($_POST["doctor"])){
                $doctorErr = "Doctor is required";
            }
            else{
                $doctor = $_POST["doctor"];
            }
        }
    }
          
            if($fnameErr == "" && $lnameErr == "" && $adateErr == "" && $atimeErr == "" && $doctorErr ==  ""){
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form'] == 'appointment_form'){
                    $db->exec("INSERT INTO appointment (appointment_id,first_name, last_name, appointment_date, appointment_time, physician_id, patient_id) VALUES 
                    (DEFAULT, '$fname', '$lname', '$adate', '$atime', (SELECT physician_id FROM physician WHERE name='$doctor'), (SELECT patient_id FROM patient WHERE name='$fname' AND last_name = "$lname" )");

                    $pquery = $db->query("SELECT * FROM appointment WHERE first_name='$fname'")->fetchAll();
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
                <div class="information">
                 <h2>Add New Appointment</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="hidden" name="form" value="appointment_form" />
                <b>First Name: </b><span class="error">*<?= $fnameErr;?></span><br>
                  <input type="text" name="first_name" value="<?=$fname?>"><br><br>
                <b>Last Name: </b><span class="error">*<?= $lnameErr;?></span><br>
                  <input type="text" name="last_name" value="<?=$lname?>"><br><br>
                <b>Appointment Date: </b><span class="error">*<?= $adateErr;?></span><br>
                  <input type="text" name="appointment_date" value="<?=$adate?>"><br><br>
                <b>Appointment Time: </b><span class="error">*<?= $atimeErr;?></span><br>
                  <input type="text" name="appointment_time" value="<?=$atime?>"><br><br>
                <b>Doctor: </b><span class="error">*<?= $doctorErr;?></span><br>
                  <input type="text" name="doctor" value="<?=$doctor?>"><br><br>
                <input type="submit">
            </form>
                 
                <h2>Current Appointments</h2>
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