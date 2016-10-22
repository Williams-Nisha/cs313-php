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
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '../modules/header.php'; ?>
        </header>
        <main>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '../modules/app.php'; ?>
        <?php
        echo 'Hello from appointment app';
        ?>
        </main>
    </body>
</html>