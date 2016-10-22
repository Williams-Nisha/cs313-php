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
            if($_POST["notes"]){
                $notes = $_POST["notes"];
            }
        }
    }
    echo 'after post validation';
    
            if($fnameErr == "" && $lnameErr == "" && $staddressErr == "" && $cityErr == "" && $stateErr == "" && $zipcodeErr == ""&& $phoneErr == "" && $birthdateErr == "" && $doctorErr == "" && $doctorErr == ""){
                
                $db->exec("
                INSERT INTO patient 
                (patient_id,first_name, last_name, street_address, city, state, zipcode, phone_number, birthdate, notes, insurance_id, physician_id) 
                VALUES 
                (DEFAULT,'$fname', '$lname', '$staddress', '$city', '$state', '$zipcode', '$phoneNumber', '$birthdate', '$notes', '$insurance_id', '$physician_id')");
                 
                $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
                $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = "";
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
                 <b>First Name: </b><span><?= $fnameErr;?></span><br>
                  <input type="text" name="first_name" value="<?=$fname?>"><br><br>
                  <b>Last Name: </b><span><?= $lnameErr;?></span><br>
                  <input type="text" name="last_name" value="<?=$lname?>"><br><br>
                  <b>Street Address: </b><span><?= $staddressErr;?></span><br>
                  <input type="text" name="street_address" value="<?=$staddress?>"><br><br>
                  <b>City: </b><span><?= $cityErr;?></span><br>
                  <input type="text" name="city" value="<?=$city?>"><br><br>
                  <b>State: </b><span><?= $stateErr;?></span><br>
                  <input type="text" name="state" value="<?=$state?>"><br><br>
                  <b>Zip Code: </b><span><?= $zipcodeErr;?></span><br>
                  <input type="text" name="zipcode" value="<?=$zipcode?>"><br><br>
                  <b>Phone Number: </b><span><?= $phoneErr;?></span><br>
                  <input type="text" name="phoneNumber" value="<?=$phoneNumber?>"><br><br>
                  <b>Birthdate: </b><span><?= $birthdateErr;?></span><br>
                  <input type="text" name="birthdate" value="<?=$birthdate?>"><br><br>   
                  <b>Preferred Doctor: </b><span></span><br>
                  <input type="text" name="pref_doctor" value="<?=$doctor?>"><br><br> 
                  <b>Insurance Information: </b><span></span><br>
                  <input type="text" name="insurance" value="<?=$insurance?>"><br><br>           
                  <b>Notes: </b><span></span><br>
                  <textarea cols="30" rows="4" name="notes"><?=$notes?></textarea><br><br>

                  <input type="submit" value="Submit">
                  <br><br>
              </form>
                <h2>New Patient Information</h2>
                   <?php
                    $query = $db->query('SELECT * FROM patient')->fetchAll();
                
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $patient = $_POST['patient'];
                        if($patient != 'list'){
                            $pquery = $db->query("SELECT * FROM patient WHERE first_name='$patient'")->fetchAll();
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
                    foreach($pquery as $rows){
                        echo '<tr>';
                        echo '<strong><td>' . $rows['patient_id'] . '</td><td>' . $rows['first_name'] . '</td><td>' . $rows['last_name'] . '</td><td>' . $rows['street_address'] . '</td><td>' . $rows['city'] . '</td><td>' . $rows['state'] . $rows['zipcode'] . '</td><td>' . $rows['phone_number'] . '</td><td>' . '</td><td>' . $rows['phone_number']. $rows['birthdate'] . '</td><td>' . $rows['notes'] . '</td><td>' .. $rows['notes'] . '</td><td>' .. $rows['insurance'] . '</td><td>' . $rows['physician'];
                        echo '</td></tr>';
                     }
                    ?>

                    </tbody>
                    </table>

             <?php echo "Hello from new patient"; ?>
            </div>
        </main>
    </body>
</html>


