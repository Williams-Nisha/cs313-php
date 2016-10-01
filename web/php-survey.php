<?php
session_start();
//$_SESSION["finishedSurvey"]= false;

// define variables and set to empty values
$vacationErr = $moneyErr = $adventureErr = $sightErr = $temperatureErr =$powerErr = "";

$vacation = $money = $adventure = $sight = $temperature = $power =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["vacation"])) {
    $vacationErr = "Vacation is required";
  } else {
    $vacation = test_input($_POST["vacation"]);
  }

  if (empty($_POST["money"])) {
    $moneyErr = "Money is required";
  } else {
    $money = test_input($_POST["money"]);
  }

  if (empty($_POST["adventure"])) {
    $adventureErr = "Adventure type is required";
  } else {
    $adventure = test_input($_POST["adventure"]);
  }

  if (empty($_POST["sight"])) {
    $sightErr = "Sight or Deaf choice is required";
  } else {
    $sight = test_input($_POST["sight"]);
  }

  if (empty($_POST["temperature"])) {
    $temperatureErr = "Temperature is required";
  } else {
    $temperature = test_input($_POST["temperature"]);
  }
  if (empty($_POST["power"])) {
    $powerErr = "Power is required";
  } else {
    $power = test_input($_POST["power"]);
  }
  if($vacationErr == "" && $moneyErr == "" && $adventureErr == "" && $sightErr == "" && $temperatureErr == "" && $powerErr == ""){
      echo "made it inside";
    $myfile = fopen("results.txt", "a") or die("Unable to open file!");
    $txt = "$vacation\n$money\n$adventure\n$sight\n$temperature\n$power\n";
    fwrite($myfile, $txt);
    fclose($myfile);
    $_SESSION["finishedSurvey"] = "true";
      var_dump($vacation,$money,$adventure,$sight, $temperature, $power);
    }
    if($_SESSION["finishedSurvey"]){
			header('Location: results.php');
			exit(); // for security use exit function after redirect
    }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<html>
    <head>
        <title>Home Page for Cs313</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="stylesheets/styles.css">
    </head>
    <body>
<!--        <? php include 'nav.php';?>-->
               <header>
            <img class ="logo" src="images/logo.png" alt="diamond logo for nisha williams">
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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h2>Would You Rather??</h2>
                <p class="bold">Take a vacation to Alaska or Hawaii?
                    <span class="error">* <?php echo $vacationErr;?></span></p>
                    <p>
                        <input type="radio" name="vacation" value="Alaska">Alaska<br>
                        <input type="radio" name="vacation" value="Hawaii">Hawaii<br>
                    </p>
            <p class="bold">Have a lot of money but no friends or have a lot of friends but no money?<span class="error">*  <?php echo $moneyErr;?></span></p>
                   <p>
                        <input type="radio" name="money" value="Rich">Rich<br>
                        <input type="radio" name="money" value="Poor">Poor<br>
                  </p>
            <p class="bold">Live a long life with no adventure or a short life full of adventure<span class="error">* <?php echo $adventureErr;?></span></p>
                   <p>
                        <input type="radio" name="adventure" value="Long">Long<br>
                        <input type="radio" name="adventure" value="Short">Short<br>  
                   </p>
            <p class="bold">Be blind or deaf? <span class="error">* <?php echo $sightErr;?></span></p>
                   <p>
                        <input type="radio" name="sight" value="Blind">Blind<br>
                        <input type="radio" name="sight" value="Deaf">Deaf<br>
                   </p>
            <p class="bold">Live in a place that is always cold or always hot?<span class="error">*  <?php echo $temperatureErr;?></span></p>
                   <p>
                        <input type="radio" name="temperature" value="Cold">Cold<br>
                        <input type="radio" name="temperature" value="Hot">Hot<br> 
                   </p>
            <p class="bold">Have a superhero power of flying or super speed?<span class="error">*  <?php echo $powerErr;?></span></p>
                   <p>
                        <input type="radio" name="power" value="Flying">Flying<br>
                        <input type="radio" name="power" value="Speed">Super Speed<br> 
                   </p>
                    <button type="submit">Submit Answers</button>
                    <p></p><a href="results.php">View Results</a><p>
            </form>
    </main>
</body>
</html>
