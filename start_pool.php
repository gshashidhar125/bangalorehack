<html>
  <head> 
    <title>
      Start a new Pool
    </title>
  </head>
  <style type="text/css">
  body { background-size: 100%; }
</style>
  <body background="car.jpg">
    <?php
       include 'configDB.php';
       include 'functions.inc.php';
       
       
       session_start();
       $email = $_SESSION['email'];
       
       if ($email != "") {

            $query = 'select name from user_master where email = "'
							      . $email . '"';

           $result = mysql_query($query, $connect)
                or die('Error executing the query' . mysql_error());
            
            $row = mysql_fetch_array($result);
            $username = $row[0];

       }
    ?>

    <center>
      <h1 style="font-family:Comic Sans Ms";text-align="center";font-size:20pt;
                                                              color:#00FF00;>
                                                              </h1>


<form name="startnewpool" id='startnewpool' action='processCreateRequest.php' method="post" onsubmit = "return validate()">
  <!--Name<input type="text" name="name" id="name"/></br>-->
Enter the below details to start a new Car Pool, <br> <br>Name: <?php echo $username; ?> <br><br>
  Origin:
  <select id = "srcAddress" name = "srcAddress">
  <?php
    $query = 'select address from list_of_address';

    $result = mysql_query($query, $connect)
         or die('Error executing the query' . mysql_error());

    while($row = mysql_fetch_array($result)) {

        echo '<option value = ' . $row[0] .'>' . $row[0] . '</option>';
    }

  ?>
  </select>
  </br></br>  
  Destination:
  <select id = "destAddress" name="destAddress">
  <?php
    $query = 'select address_id, address from list_of_address';

    $result = mysql_query($query, $connect)
         or die('Error executing the query' . mysql_error());

    while($row = mysql_fetch_array($result)) {

        echo '<option value = ' . $row[1] .'>' . $row[1] . '</option>';
    }

  ?>
  </select>
  </br></br>  
  Departure Time : <input type = "text" name = "departureTime" id="dtime"> <br>
  Total Seats Available: <input type = "text" name = "TotalAvailableSeats" id="tseats"> <br>
  <input type="submit" value="Submit Car pool Request"/>
  <div id="err" style="color:red"> </div>
</form>

<script language="javascript">
	function validate(){
		if(document.getElementById("tseats").value.trim() == "" || document.getElementById("dtime").value.trim() == "" ) {
			document.getElementById("err").innerHTML = "Enter Time";
			return false;
		}
		return true
	}

</script>
</center>
</body>
</html>

