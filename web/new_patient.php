<?php
require('db_connection.php');
//error_reporting(E_ALL);
//ini_set('display_errors', true);
?>
<?php
   $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
   $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = "";

       if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'patient_form') {
            if(empty($_POST["first_name"])){
                $fnameErr = "First name is required";
            }
            else{
                $fname = $_POST["first_name"];
            }
            if(empty($_POST["last_name"])){
                $lnameErr = "Last name is required";
            }
            else{
                $lname = $_POST["last_name"];
            }
            if(empty($_POST["street_address"])){
                $staddressErr = "Street address is required";
            }
            else{
                $staddress = $_POST["street_address"];
            }
             if(empty($_POST["city"])){
                $cityErr = "City is required";
            }
            else{
                $city = $_POST["city"];
            }
             if(empty($_POST["state"])){
                $stateErr = "State is required";
            }
            else{
                $state = $_POST["state"];
            }
             if(empty($_POST["zipcode"])){
                $zipcodeErr = "Zip code is required";
            }
            else{
                $zipcode = $_POST["zipcode"];
            }
            if(empty($_POST["phoneNumber"])){
                $phoneErr = "Phone number is required";
            }
            else{
                $phoneNumber = $_POST["phoneNumber"];
            }
            if(empty($_POST["birthdate"])){
                $birthdateErr = "Birthdate is required";
            }
            else{
                $birthdate = $_POST["birthdate"];
            }
            if($_POST["doctor"]){
                $doctor = $_POST["doctor"];
            }
            if($_POST["insurance"]){
                $insurance = $_POST["insurance"];
            }
            if($_POST["notes"]){
                $notes = $_POST["notes"];
            }
        }
    }
            if($fnameErr == "" && $lnameErr == "" && $staddressErr == "" && $cityErr == "" && $stateErr == "" && $zipcodeErr == ""&& $phoneErr == "" && $birthdateErr ==  ""){
                    $patient_found = FALSE;
                    $find_patient = $db->query(
                    "SELECT CASE WHEN EXISTS
                    (SELECT * from patient
                    WHERE first_name = '$fname'
                    AND last_name = '$lname')
                    THEN 1
                    ELSE 0
                    END"
                )->fetchAll();
                  
                  foreach($find_patient as $find){ 
                        if($find[0] == 1){
                          $patient_found = TRUE;
//                          echo 'Patient is in system';
                          $patientErr = 'Patient cannot be added. Patient is already in the system.';
                          break;
                      } else {
                          $patientErr = '';
//                          echo 'Patient is not in system.';
                      }
                  }
                if(!$patient_found){
                    $db->exec("INSERT INTO patient (patient_id,first_name, last_name, street_address, city, state, zip_code, phone_number, birthdate, notes, insurance_id, physician_id) VALUES 
                    (DEFAULT, '$fname', '$lname', '$staddress', '$city', '$state', '$zipcode', '$phoneNumber', '$birthdate', '$notes', (SELECT insurance_id FROM insurance WHERE name='$insurance'), (SELECT physician_id FROM physician WHERE first_name='$doctor'))");
                    $inserted = 'The patient has been added to our system.';

                    $pquery = $db->query("SELECT * FROM patient WHERE first_name='$fname'")->fetchAll();
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
            <h2>Add New Patient</h2>
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="hidden" name="action" value="patient_form">
                <input type="hidden" name="form" value="patient_form">
                 <b>First Name: </b><span class="error">*<?= $fnameErr;?></span><br>
                  <input type="text" name="first_name" value="<?=$fname?>"><br><br>
                  <b>Last Name: </b><span class="error">*<?= $lnameErr;?></span><br>
                  <input type="text" name="last_name" value="<?=$lname?>"><br><br>
                  <b>Street Address: </b><span class="error">*<?= $staddressErr;?></span><br>
                  <input type="text" name="street_address" value="<?=$staddress?>"><br><br>
                  <b>City: </b><span class="error">*<?= $cityErr;?></span><br>
                  <input type="text" name="city" value="<?=$city?>"><br><br>
                  <b>State: </b><span class="error">*<?= $stateErr;?></span><br>
                  <input type="text" name="state" value="<?=$state?>"><br><br>
                  <b>Zip Code: </b><span class="error">*<?= $zipcodeErr;?></span><br>
                  <input type="text" name="zipcode" value="<?=$zipcode?>"><br><br>
                  <b>Phone Number: Format (555)555-5555</b><span class="error">*<?= $phoneErr;?></span><br>
                  <input type="text" name="phoneNumber" value="<?=$phoneNumber?>"><br><br>
                  <b>Birthdate: Format(Year-Month-Day) </b><span class="error">*<?= $birthdateErr;?></span><br>
                  <input type="text" name="birthdate" value="<?=$birthdate?>"><br><br>   
                 <b>Preferred Doctor: First Name</b><br>
                  <input type="text" name="doctor" value="<?=$doctor?>"><br><br> 
                  <b>Insurance Information: </b><br>
                  <input type="text" name="insurance" value="<?=$insurance?>"><br><br>           
                  <b>Notes: </b><br>
                  <textarea cols="30" rows="4" name="notes"><?=$notes?></textarea><br><br>

                  <input type="submit" value="Submit">
                  <br><br>
              </form>
                <h2>New Patient Information</h2>
                <p><span><?=$inserted;?></span></p>
                <p><span class="error"><?=$patientErr; ?></span></p>
                <div class="information">
                    <table>
                        <thead>
                           <tr> 
                            <th>Patient Name</th> 
                            <th>Street Address</th> 
                            <th>City</th>
                            <th>State</th>
                            <th>Zip Code</th>
                            <th>Phone #</th> 
                            <th>Birthdate</th> 
                            <th>Notes</th> 
                            <th>Insurance</th> 
                            <th>Physician</th> 
                          </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach($pquery as $rows){
                         echo '<tr>';
                        echo '<strong><td>' . $rows['first_name'] . ' ' . $rows['last_name'] . '</td><td>' . $rows['street_address'] . '</td><td>' . $rows['city'] . '</td><td>' . $rows['state'] . '</td><td>' . $rows['zip_code'] . '</td><td>' . $rows['phone_number'] . '</td><td>'. $rows['birthdate'] . '</td><td>' . $rows['notes'];
                            foreach($db->query("SELECT * FROM insurance i INNER JOIN patient p ON i.insurance_id = p.insurance_id WHERE p.first_name='" . $rows['first_name'] . "'") as $insurance){
                        echo '</td><td>' . $insurance['name'] . "</td>";
                        break;
                    }
                         foreach($db->query("SELECT * FROM patient pa INNER JOIN physician p ON pa.physician_id = p.physician_id WHERE p.physician_id='" . $rows['physician_id'] . "'") as $physician){
                             
                        echo '</td><td>' . $physician['first_name'] . ' ' . $physician['last_name'] . "</td></tr>";
                        break;
                    }
                    echo '</td></tr>';
                    
                     }
                        $fname = $lname = $staddress = $city = $state = $zipcode= $phoneNumber= $birthdate = $doctor = $insurance = $notes = "";
                        $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = $patientErr = $patient_found = "";
                    ?>

                    </tbody>
                    </table>
            </div>
            </div>
        </main>
    </body>
</html>


