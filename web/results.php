
<html>
    <head>
        <title>Home Page for Cs313</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="stylesheets/styles.css">
    </head>
    <body>
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
        <h2>
            Survey Results
        </h2>
        <table id="results">
            <thead>
                <th>Vacation</th>
                <th>Money or Friends?</th>
                <th>Adventure or No Adventure?</th>
                <th>Blind or Deaf?</th>
                <th>Always Cold or Always Hot?</th>
                <th>Flying or Speed?</th>
            </thead>
            <tbody>
            <?php
                $myfile = fopen("results.txt", "r") or die("Unable to open file!");
                while(!feof($myfile)){
                    $check = fgets($myfile);
                    if($check != ""){
                    echo "<tr><td>" . $check . "</td><td>" . fgets($myfile) . "</td><td>" . fgets($myfile) . "</td><td>" . fgets($myfile) . "</td><td>" . fgets($myfile) . "</td><td>" . fgets($myfile) . "</td></tr>";
                    }
                }
                fclose($myfile); 
            ?>  
            </tbody>
        </table>
        </main>
    </body>          
</html>