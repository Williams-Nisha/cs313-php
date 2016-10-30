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
                  echo $adate . ' ' . $atime;
                 $timestamp = $adate . " " . $atime;
                  $date = date('Y-m-d H:i:s', strtotime($timestamp));
                  echo $date;
                  $has_schedule = FALSE;
                  $has_appointment = FALSE;
                  $schedule = $db->query(
                    "SELECT
                        s.start_time
                    ,   s.end_time
                    ,   p.physician_id
                    ,   p.first_name
                    FROM schedule s INNER JOIN physician p
                    ON  s.physician_id = p.physician_id
                    WHERE p.first_name = '$doctor'"
                )->fetchAll();
                  
                  foreach($schedule as $sched){
                      
                      if($date >= $sched['start_time'] && $date <= $sched['end_time']){
                          echo 'doctor is available';
                          $has_schedule = TRUE;
                              
                      } else {
                          echo 'doctor is not available';                      }
                  }
                  
                try {
                $appointment = $db->query(
                    "SELECT
                        a.appointment_date
                    ,   p.physician_id
                    ,   p.first_name
                    FROM appointment a INNER JOIN physician p
                    ON  a.physician_id = p.physician_id
                    WHERE p.first_name = '$doctor'"
                )->fetchAll();
                  
                    foreach($appointment as $appoint){
                        if($appoint['appointment_date'] == $date ){
                          echo 'doctor has an appointment at that time';
                          $has_appointment = TRUE;
                              
                      } else {
                          echo 'doctor is available at that time';                      }
                          
                          
                      } 
                } catch (exception $e){
                    $has_appointment = FALSE;
                }
                  if($has_schedule && !$has_appointment){
                      $db->exec("INSERT INTO appointment (appointment_id, appointment_date, physician_id, patient_id) VALUES 
                   (DEFAULT, '$date', (SELECT physician_id FROM physician WHERE first_name='$doctor'), (SELECT patient_id FROM patient WHERE first_name='$fname'))"); 
                  }
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
                <b>Appointment Date: </b> Format: YYYY:MM:DD<span class="error">*<?= $adateErr;?></span><br>
                  <input type="text" name="appointment_date" value="<?=$adate?>"><br><br>
                <b>Appointment Time: </b> Format: HH:MM:SS<span class="error">*<?= $atimeErr;?></span><br>
                  <input type="text" name="appointment_time" value="<?=$atime?>"><br><br>
                <b>Doctor: </b> First Name Only<span class="error">*<?= $doctorErr;?></span><br>
                  <input type="text" name="doctor" value="<?=$doctor?>"><br><br>
                <input type="submit">
            </form>
                 
                <h2>Current Appointments</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>  
                        <th>Appointment Time</th> 
<!--                        <th>Start Time</th>-->
<!--                        <th>End Time</th>-->
                        <th>Doctor</th>
                    </tr>
                </thead>
                <tbody>
                     <?php
                         
//                    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form'] == 'appointment_form'){
                    $sched_apts = $db->query("SELECT * FROM appointment a INNER JOIN patient p ON a.patient_id = p.patient_id;")->fetchAll();
                     foreach($sched_apts as $rows){
                        echo '<tr>';
                        echo  '<td>'. $rows['first_name'] . ' ' . $rows['last_name'] . '</td><td>' . $rows['appointment_date']; 
                         echo $rows['physician_id'];
                        foreach($db->query("SELECT a.physician_id, p.first_name, p.last_name,  FROM appointment a INNER JOIN physician p ON a.physician_id = p.physician_id WHERE p.physician_id = a.physician_id") as $doctor){
//                            if($doctor['physician_id'] == $rows['physician_id']){
                        echo '</td><td>' . $doctor['first_name'] . ' '. $doctor['last_name'] . '</td></tr>';
                            break;
                           }
                            echo '</td></tr>';
//                   } //else {
//                            '</td><td>';
//                        }
                        
                     }
                         
//                    }
//                    $sched_apts = $db->query("SELECT * FROM appointment a JOIN physician p ON a.physician_id = p.physician_id INNER JOIN schedule s ON s.physician_id = p.physician_id INNER JOIN patient pa ON pa.physician_id = p.physcian_id;") 
//               
                    ?>
                </tbody>
            </table>
                </div>
              </div>
        </main>
    </body>
</html>