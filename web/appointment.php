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
//                   $db->query("SELECT * FROM appointment a JOIN physician p ON a.physician_id = p.physician_id INNER JOIN schedule s ON s.physician_id = p.physician_id INNER JOIN patient pa ON pa.physician_id = p.physician_id;") as $appointment)
                  echo $adate . ' ' . $atime;
                 $timestamp = $adate . " " . $atime;
                  $date = date('Y-m-d H:i:s', strtotime($timestamp));
                  echo $date;
//                  $has_schedule = FALSE;
//                $available = $db->query(
//                    "SELECT
//                        a.appointment_date
//                    ,   s.start_time
//                    ,   s.end_time
//                    ,   p.physician_id
//                    ,   p.first_name
//                    FROM schedule s INNER JOIN physician p
//                    ON  s.physician_id = p.physician_id
//                    LEFT JOIN appointment a
//                    ON a.physician_id = p.physician_id
//                    WHERE p.first_name = '$doctor'
//                    AND $date >= s.start_time
//                    AND $date <= s.end_time"
//                )->fetchAll();
//                  
//                   $has_appointment = FALSE;
//                  
//                    foreach($available as $appointment){
//                        $has_schedule = TRUE;
//                        if($appointment['appointment_date'] == $timestamp){
//                            $has_appointment = TRUE;
//                            
////                            $timestamp =  'SELECT date_part('hour', timestamp "' . $timestamp . '")';
////                            $timestamp1 = 'SELECT date_part('hour', timestamp"' . $timestamp . '")';
////                            $hour = $db->query('SELECT extract(hour from timestamp "' . $timestamp . '")');
////                            echo 'there are no results';
////                            var_dump($hour);
////                            echo $doctor;
////                            if( $timestamp >= $timestamp1){
////                                echo "time is bigger";
////                            }
////                        } else {
////                            echo "time is smaller";
////                            $db->exec("INSERT INTO appointment (appointment_id, appointment_date, physician_id, patient_id) VALUES 
////                    (DEFAULT, '$adate', (SELECT physician_id FROM physician WHERE first_name='$doctor'), (SELECT patient_id FROM patient WHERE first_name='$fname'))"); 
//                            
////                        } else {
////                        if($appointment.length > 0 &&){
////                            echo 'You may create an appointment';
////                        } else if(appointment['start_date'])
////                        echo 'there are results';
//                        }
//                    }
//                  if(!$has_appointment && $has_schedule){
//                      echo 'doctor is available';
//                      
//                  }
//                  
////                        
////                foreach($pquery as $appointment){
////                  foreach($db->query("SELECT * FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.patient_id='" . $row['$fname'] . "'") as $appointment){
////                    $timestamp = $adate . " " . $atime; 
//////                    $hour = 'SELECT extract(hour from timestamp "' . $timestamp . '")';
////                    $subHours = 'extract(epoch from $timestamp' . '-' . $appointment['start_date'].')/3600';
////                    if($pquery['$hour'] >= 'SELECT extract(hour from timestamp "'. $pquery['start_time'].'")' && $pquery['$hour']<= 'SELECT extract(hour from timestamp "'. $pquery['end_time'].'")'){
////                      
////                  echo 'You are able to book appointment';
////                    } else {
////                        echo ' The appoinment is out of date range.';
////                    }
////                      
////                }
                  

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
    </head>-
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
            <select name="patient">
                <option value="list">All Patients</option> 
                  <h2>Patient Information</h2>
                   <?php
                    $query = $db->query('SELECT * FROM patient')->fetchAll();
                
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $patient = $_POST['patient'];
                        if($patient != 'list'){
                            $query = $db->query("SELECT * FROM patient WHERE first_name='$patient'")->fetchAll();
                        }
                    }

                    foreach($db->query('SELECT DISTINCT first_name FROM patient')->fetchAll() as $patient){
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if($_POST["patient"] == $patient["first_name"]){ 
                                $selected = "selected='selected'";
                            }
                            else{
                                $selected = "";
                            }
                        }
                        echo '<option value="' . $patient['first_name'] . '"' . $selected . '>' . $patient['first_name'] . '</option>';
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
//                    foreach($query as $row){
//                        if(select exists(select 1 from appointment where patient_id="(SELECT patient_id FROM patient WHERE patient_id='$fname')")){
//                    echo '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
//                    foreach($db->query("SELECT * FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.patient_id='" . $row['patient_id'] . "'") as $appointment){
//                        echo '<td>' . $appointment['appointment_date'] . "</td><td>" . $appointment['appointment_date'] . "</td><td>" . $appointment['physician_id'] ;
//                    }
//                    echo '</td></tr>';
//                        }
//            }
//                    foreach($pquery as $row){
//                foreach($db->query("SELECT * FROM appointment a JOIN patient p ON a.patient_id = p.patient_id WHERE a.patient_id='" . $row['$fname'] . "'") as $appointment){
//                echo '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
//                echo '<td>' . $appointment['appointment_date'] . "</td><td>" . $appointment['appointment_date'] . "</td><td>" . $appointment['physician_id'] ;
//                    }
//                    echo '</td></tr>';
//                    }
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