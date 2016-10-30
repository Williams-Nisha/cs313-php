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
               <h4>Doctor List</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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
            </form>
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
                        echo '<strong><td>' . $row['physician_id'] . '</td><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['phone_number'];
                            foreach($db->query("SELECT * FROM specialty s JOIN physician p ON s.physician_id = p.physician_id WHERE s.physician_id='" . $row['physician_id'] . "'") as $specialty){
                        echo '</td><td>' . $specialty['name'] . "</td></tr>";
                        break;
                    }
                    echo '</td></tr>';
                     }
                    ?>
                </tbody>
            </table>
              </div>
          </div>
        </main>
    </body>
</html>
