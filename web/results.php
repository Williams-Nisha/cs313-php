<?php
session_start();

    $myfile = fopen("results.php", "w") or die("Unable to open file!");
    $read = fopen("results.php", "r") or die("Unable to open file!"); echo fread($myfile,filesize("results.php")); fclose($myfile);
    $vacation =  echo $_POST["vacation"]; 
    $money = echo $_POST["money"]; 
    $adventure = php echo $_POST["adventure"]; 
    $sight = php echo $_POST["sight"]; 
    $temperature = php echo $_POST["temperature"]; 
    $power = php echo $_POST["power"]; 
    fwrite($myfile "$vacation;$money;$adventure;$sight;$temperature;$power");
    fclose($myfile);
?>