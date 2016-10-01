<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Would You Rather Survey</title>
</head>
<body>
    <h1>Would you rather...</h1>
    <form action="results.php"method="post">
        <h2>Would you rather:</h2>
        Take a vacation to Alaska or Hawaii?<br>
            <input type="radio" name="vacation" value="Alaska">Alaska<br>
            <input type="radio" name="vacation" value="Hawaii">Hawaii<br>
        Have a lot of money but no friends or have a lot of friends but no money<br>
            <input type="radio" name="money" value="Rich">Rich<br>
            <input type="radio" name="money" value="Poor">Poor<br>   
        Live a long life with no adventure or a short life full of adventure<br>
            <input type="radio" name="adventure" value="long">Long<br>
            <input type="radio" name="adventure" value="short">Short<br>  
         Be blind or deaf?<br>
            <input type="radio" name="sight" value="Blind">Blind<br>
            <input type="radio" name="sight" value="Deaf">Deaf<br>   
        Live in a place that is always cold or always hot?<br>
            <input type="radio" name="temperature" value="Cold">Cold<br>
            <input type="radio" name="temperature" value="Hot">Hot<br> 
        Have a superhero power of flying or super speed?<br>
            <input type="radio" name="power" value="Flying">Flying<br>
            <input type="radio" name="power" value="Speed">Super Speed<br> 
            <button type="submit">Submit Answers</button>
            <label>View Results</label>
    </form>
</body>
</html>
