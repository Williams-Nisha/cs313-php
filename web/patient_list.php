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
               <h4>Patient List</h4>
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
                            <th></th> 
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
                    foreach($query as $rows){
                        echo '<tr>';
                        echo '<strong><td>' . $rows['patient_id'] . '</td><td>' . $rows['first_name'] . ' ' . $rows['last_name'] . '</td><td>' . $rows['street_address'] . '</td><td>' . $rows['city'] . '</td><td>' . $rows['state'] . '</td><td>' . $rows['zipcode'] . '</td><td>' . $rows['phone_number'] . '</td><td>'. $rows['birthdate'] . '</td><td>' . $rows['notes'];
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
                    ?>
                    </tbody>
                    </table>
                    </div>
                </div>
        <?php
            echo 'Hello from patient list';
        ?>
        </main>
    </body>
</html>
                    