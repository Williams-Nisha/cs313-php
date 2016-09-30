?php 
    $name = $email = $major = $places = $comments = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['name'])){
            $name = htmlspecialchars($_POST['name']);
        }
        if(isset($_POST['email'])){
            $email = htmlspecialchars($_POST["email"]);
        }
        if(isset($_POST['major'])){
            $major = $_POST["major"];
        }
        if(!empty($_POST['checkbox'])){
            $places = $_POST['checkbox'];
        }
        $comments = htmlspecialchars($_POST["comments"]);
    }
?>

<html>
<body>
    <a href="week03ta.html">Back to Form</a><br><br>
    <b>Name:</b> <?php echo $name; ?><br><br>
    <b>Email:</b> <a href="mailto:<?php echo $email; ?>"><?php echo $email;?></a><br><br>
    <b>Major:</b> <?php echo $major; ?><br><br>
    <b>Places you have been:</b><br>
     <?php 
        if(!empty($places)){
            foreach($places as $check){
                echo $check . "<br>";
            }
        }
        ?>
    <br>
    <b>Your comments:</b><br/>
    <?php echo $comments; ?>

</body>
</html>