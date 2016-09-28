
<html>
<body>

Name: <?php echo $_POST["name"]; ?><br>
Email: <a href ="mailto:<?php echo $_POST["email"]; ?>"><?php echo $_POST["email"]; ?></a><br>
Major: <?php echo $_POST["major"]; ?><br>
Places you have been: <br>
    <?php 
        if(!empty($_POST['checkbox'])) {
            foreach($_POST['checkbox'] as $check) {
                echo $check . "<br>";
            }
        }
    ?><br>
    Your comments: <br>
    <?php echo $_POST["comments"]; ?>

</body>
</html>