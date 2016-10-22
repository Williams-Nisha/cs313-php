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
        $echo 'Hello from new patient';
        ?>
        </main>
    </body>
</html>
<?php
//   $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
//   $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = "";
//    
//    if (isset($_POST) && !empty($_POST)){
//        if($_POST['form'] == 'patientform') {
//            if(empty($_POST["first_name"])){
//                $fnameErr = "First name is required";
//            }
//            else{
//                $fname = $_POST["first_name"];
//            }
//            if(empty($_POST["last_name"])){
//                $lnameErr = "Last name is required";
//            }
//            else{
//                $lname = $_POST["last_name"];
//            }
//            if(empty($_POST["street_address"])){
//                $staddressErr = "Street address is required";
//            }
//            else{
//                $staddress = $_POST["street_address"];
//            }
//             if(empty($_POST["city"])){
//                $cityErr = "City is required";
//            }
//            else{
//                $city = $_POST["city"];
//            }
//             if(empty($_POST["state"])){
//                $stateErr = "State is required";
//            }
//            else{
//                $state = $_POST["state"];
//            }
//             if(empty($_POST["zipcode"])){
//                $zipcodeErr = "Zip code is required";
//            }
//            else{
//                $zipcode = $_POST["zipcode"];
//            }
//            if(empty($_POST["phoneNumber"])){
//                $phoneErr = "Phone number is required";
//            }
//            else{
//                $phoneNumber = $_POST["phoneNumber"];
//            }
//            if(empty($_POST["birthdate"])){
//                $birthdateErr = "Birthdate is required";
//            }
//            else{
//                $birthdate = $_POST["birthdate"];
//            }
//            if($_POST["doctor"])){
//                $doctor = $_POST["doctor"];
//            }
//            if($_POST["notes"])){
//                $notes = $_POST["notes"];
//            }
//        }
//    }

    
//            if($fnameErr == "" && $lnameErr == "" && $staddressErr == "" && $cityErr == "" && $stateErr == "" && $zipcodeErr == ""&& $phoneErr == "" && $birthdateErr == "" && $doctorErr == "" && $doctorErr == ""){
//                
//                $db->exec("
//                INSERT INTO patient 
//                (patient_id,first_name, last_name, street_address, city, state, zipcode, phone_number, birthdate, notes, insurance_id, physician_id) 
//                VALUES 
//                (DEFAULT,'$fname', '$lname', '$staddress', '$city', '$state', '$zipcode', '$phoneNumber', '$birthdate', '$notes', '$insurance_id', '$physician_id')");
//                 
//                $fname = $lname = $staddress = $birthdate = $doctor = $insurance = $notes = "";
//                $fnameErr = $lnameErr = $staddressErr = $birthdateErr = $cityErr = $stateErr =  $phoneErr = $zipcodeErr = $notesErr = "";
//            }
?>

