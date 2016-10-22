<?php
require('db_connection.php');
?>
<?php
   $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
   $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = "";
    echo 'Before post validation';
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
    echo 'after post validation';
          var_dump($fname,$lname,$staddress,$city, $state, $zipcode, $phoneNumber, $birthdate, $doctor, $insurance, $notes);
            if($fnameErr == "" && $lnameErr == "" && $staddressErr == "" && $cityErr == "" && $stateErr == "" && $zipcodeErr == ""&& $phoneErr == "" && $birthdateErr ==  ""){
                echo 'before insert statement';
                $db->exec("INSERT INTO patient (patient_id,first_name, last_name, street_address, city, state, zipcode, phone_number, birthdate, notes, insurance_id, physician_id) VALUES 
                (DEFAULT, '$fname', '$lname', '$staddress', '$city', '$state', '$zipcode', '$phoneNumber', '$birthdate', '$notes', (SELECT insurance_id FROM insurance WHERE name=' . $insurance .')', (SELECT physician_id FROM physician WHERE first_name=' . $doctor . ')'");
                                             
    echo "after insert statement";
                $fname = $lname = $staddress = $city = $state = $zipcode= $phoneNumber= $birthdate = $doctor = $insurance = $notes = "";
                $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = "";
            }
          var_dump($fname,$lname,$staddress,$city, $state, $zipcode, $phoneNumber, $birthdate, $doctor, $insurance, $notes);
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
                   <?php
                $pquery = $db->query("SELECT * FROM patient WHERE first_name='$patient'")->fetchAll();
                ?>
                <div class="information">
                    <table>
                        <thead>
                           <tr>
                            <th></th> 
                            <th>First Name</th> 
                            <th>Last Name</th>
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
//                    foreach($pquery as $rows){
//                        echo '<tr>';
//                        echo '<strong><td>' . $rows['patient_id'] . '</td><td>' . $rows['first_name'] . '</td><td>' . $rows['last_name'] . '</td><td>' . $rows['street_address'] . '</td><td>' . $rows['city'] . '</td><td>' . $rows['state'] . $rows['zipcode'] . '</td><td>' . $rows['phone_number'] . '</td><td>' . '</td><td>' . $rows['phone_number']. $rows['birthdate'] . '</td><td>' . $rows['notes'] . '</td><td>' .. $rows['notes'] . '</td><td>' .. $rows['insurance'] . '</td><td>' . $rows['physician'];
//                        echo '</td></tr>';
//                     }
                    ?>

                    </tbody>
                    </table>
            </div>
            </div>
        </main>
    </body>
</html>


