<?php
   require('db_connection.php');

   $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
   $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = "";
    
    if (isset($_POST) && !empty($_POST)){
        if($_POST['form'] == 'patientform') {
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
            if($_POST["doctor"])){
                $doctor = $_POST["doctor"];
            }
            if($_POST["notes"])){
                $notes = $_POST["notes"];
            }
        }
    }

    
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
       
   </head>
    <body>
        <div id="results">
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="addForm">
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
                  <input type="text" name="birthdate" value="<?=birthdate?>"><br><br>   
                  <b>Preferred Doctor: </b><span></span><br>
                  <input type="text" name="pref_doctor" value="<?=$doctor?>"><br><br> 
                  <b>Insurance Information: </b><span></span><br>
                  <input type="text" name="insurance" value="<?=$insurance?>"><br><br>           
                  <b>Notes: </b><span></span><br>
                  <textarea cols="30" rows="4" name="notes"><?=$notes?></textarea>
                  <br><br>
                  <input type="hidden" name="form" value="patientform" />

                  <input type="submit" value="Submit">
                  <br><br>
             </form>
             <div id="newpatient">
                <?php include('index.php');?>
             </div>
        </div>
    </body>
</html>