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
              <h2 class="center">Mountainland Family Medicine</h2>
              <h4 class="center">Appointment Setting Application</h4>
              <div class="preview">
                  <img class="expand" src="images/medoffice.jpg" alt="Mountainland Family Medicine">    
            </div>
            </div>
        </main>
    </body>
</html>