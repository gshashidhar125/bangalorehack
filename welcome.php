<html>
   <head>
        <title>
            Welcome Page
        </title>
   </head>

<body>
<?php
    include "configDB.php";

    session_start();
?>    
 <center>
    <h1 style="font-family:Comic Sans Ms";text-align="center";font-size:20pt;
                color:#00FF00;>
                            Select an Option
                                    </h1>

 <a href="start_pool.php">Start a new pool(I have a car !!) </a>
 <br>
 <a href="pool_request.php">Request for a pool </a>

</center>
</body>

</html>
