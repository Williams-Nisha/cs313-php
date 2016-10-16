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
            <img class="logo" src="../images/logo.png" alt="diamond logo for nisha williams">
        </header>
         <nav class="navbar navbar-inverse">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
             <li><a href="index.html">Home</a></li>
             <li><a href="about.html">About Me</a></li>
            </ul>
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="assignments.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignments<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="./WebstoreHackathon.html" class="musicName">Name</a></li>
                  <li><a href="./WebstoreHackathon.html" class="musicPrice">Price</a></li>
                  <li><a href="./WebstoreHackathon.html" class="musicCategory">Category</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form navbar-right" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default nav-button">Submit</button>
          </form>
          </div>
        </nav>
        <main class="content">
       <?php
        session_start(); 
        // default Heroku Postgres configuration URL
        $dbUrl = getenv('DATABASE_URL');

        if (empty($dbUrl)) {
         // example localhost configuration URL with postgres username and a database called cs313db
            require('/app/local_db.php');
        }

        $dbopts = parse_url($dbUrl);
        $dbHost = $dbopts["host"]; 
        $dbPort = $dbopts["port"]; 
        $dbUser = $dbopts["user"]; 
        $dbPassword = $dbopts["pass"];
        $dbName = ltrim($dbopts["path"],'/');
            
        try {
            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
         }
        catch (PDOException $ex) {
            print "<p>error: $ex->getMessage() </p>\n\n";
            die();
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <h2>Mountainland Family Medicine</h2>
            <h4>Find a Doctor</h4>
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
                    <h4>Patient List</h4>
            <select name="patient">
                <option value="all">All Patients</option> 
                  <h2>Patient Information</h2>
                   <?php
                    $query = $db->query('SELECT * FROM patient')->fetchAll();
                
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $patient = $_POST['patient'];
                        if($patient != 'all'){
                            $query = $db->query("SELECT * FROM patient WHERE first_name='$patient'")->fetchAll();
                        }
                    }

                    foreach($db->query('SELECT DISTINCT first_name FROM patient')->fetchAll() as $doctor){
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
                            <th>Phone #</th> 
                            <th>Specialty</th>
                            <th>Birthdate</th> 
                            <th>City</th>
                          </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach($query as $row){
                        echo '<tr>';
                        echo '<strong><td>' . $row['patient_id'] . '</td><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['street_address'] . '</td><td>' . $row['phone_number'] . '</td><td>' . $row['birthdate'] . '</td><td>' . $row['city'];
                        echo '</td></tr>';
                     }
                    ?>
                    </tbody>
                    </table>
                    </div>
        </form>
    </main>    
    </body>
</html>