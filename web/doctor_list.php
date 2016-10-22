<?php
require('db_connection.php');
?>
    <select name="doctor">
        <option value="all">All Doctors</option> 
             <h2>Doctor Information</h2>
             <?php
                $query = $db->query('SELECT * FROM physician')->fetchAll();
                
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $doctor = $_POST['doctor'];
                    if($doctor != 'all'){
                        $query = $db->query("SELECT * FROM physician WHERE first_name='$doctor'")->fetchAll();
                    }
                }

                foreach($db->query('SELECT DISTINCT first_name FROM physician')->fetchAll() as $doctor){
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($_POST["doctor"] == $doctor["first_name"]){ 
                            $selected = "selected='selected'";
                        }
                        else{
                            $selected = "";
                        }
                    }
                    echo '<option value="' . $doctor['first_name'] . '"' . $selected . '>' . $doctor['first_name'] . '</option>';
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
                        <th>Phone #</th> 
                        <th>Specialty</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($query as $row){
                        echo '<tr>';
                        echo '<strong><td>' . $row['physician_id'] . '</td><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['phone_number'] . '</td><td>' . $row['specialty_id'];
                        echo '</td></tr>';
                     }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="scriptures">
            <?php include('index.php');?>
         </div>