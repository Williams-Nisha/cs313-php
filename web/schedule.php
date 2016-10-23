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
                  <h4>Doctor Schedules</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                   <select name="physician">
        <option value="all">All Schedules</option> 
             <?php
                $query = $db->query('SELECT * FROM physician')->fetchAll();
                
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $physician = $_POST['physician'];
                    if($physician != 'all'){
                        $query = $db->query("SELECT * FROM physician WHERE first_name='$physician'")->fetchAll();
                    }
                }

                foreach($db->query('SELECT DISTINCT first_name FROM physician')->fetchAll() as $physician){
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if($_POST["physician"] == $physician["first_name"]){ 
                            $selected = "selected='selected'";
                        }
                        else{
                            $selected = "";
                        }
                    }
                    echo '<option value="' . $physician['first_name'] . '"' . $selected . '>' . $physician['first_name'] . '</option>';
                }
                ?>       
                <input type="submit" value="Search"/>
        </select>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Doctor Name</th> 
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($query as $row){
                    echo '<tr><td>' . $row['first_name'] . ' ' . $row['last_name'] . '</td>';
                    foreach($db->query("SELECT * FROM schedule s JOIN physician p ON s.schedule_id = p.physician_id WHERE physician_id='" . $row['physician_id'] . "'") as $schedule){
                        echo '<td>' . $schedule['start_time'] . "</td></td>" . $schedule['end_time'];
                    }
                    echo '</td></tr>';
            }
                    ?>
                </tbody>
            </table>
                </div>
              </div>
        <?php
            echo 'Hello from schedule page';
        ?>
        </main>
    </body>
</html>