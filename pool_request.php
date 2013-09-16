<html>
  <style type="text/css">
  body { background-size: 100%; }
  </style>
  <head> 	
	<link href="datepicker.css" rel="stylesheet" />
    <title>
      Request for Car Pool
    </title>
  </head>
  
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


<form name="newpoolrequest" id='newpoolrequest' action='processPoolRequest.php' method="post" onsubmit = "return check()">
  <!--Name<input type="text" name="name" id="name"/></br>-->
Enter the below details to Request for a Car Pool, <br> <br>
  Name: <?php echo $username; ?> <br><br>
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
  <select id = "destAddress" name = "destAddress">
  <?php
    $query = 'select address_id, address from list_of_address';

    $result = mysql_query($query, $connect)
         or die('Error executing the query' . mysql_error());

    while($row = mysql_fetch_array($result)) {

        echo '<option value = ' . $row[1] .'>' . $row[1] . '</option>';
    }
    
    echo '</select>';
    echo '</br></br> ';

	$today = new DateTime();
	
	echo 'Estimated Departure Time';
	echo '<select id=\'date1\' name=\'date1\'>';
		echo '<option value="';
		echo $today->format( 'Y-m-d' );
		echo '">';
			echo $today->format( 'Y-m-d' );
			
			$datetime = new DateTime(); 
			
			$issue_date = $datetime->format('Y-m-d'); // Prints "2011/03/20 07:16:17" 
			$expiry_date = date('Y-m-d', strtotime($issue_date. ' + 1 day'));

		echo '</option>';
		echo '<option value="';
		echo $expiry_date;
		echo'">';
			echo $expiry_date;
		echo '</option>';
	echo '</select>';
  ?>  

  

<select id="time1" name="time1">
	<option value="05:00:00">05:00</option>
	<option value="05:30:00">05:30</option>
	<option value="06:00:00">06:00</option>
	<option value="06:30:00">06:30</option>
	<option value="07:00:00">07:00</option>
	<option value="07:30:00">07:30</option>
	<option value="08:00:00">08:00</option>
	<option value="08:30:00">08:30</option>
	<option value="09:00:00">09:00</option>
	<option value="09:30:00">09:30</option>
	<option value="10:00:00">10:00</option>
	<option value="10:30:00">10:30</option>
	<option value="11:00:00">11:00</option>
	<option value="11:30:00">11:30</option>
	<option value="12:00:00">12:00</option>
	<option value="12:30:00">12:30</option>
	<option value="13:00:00">13:00</option>
	<option value="13:30:00">13:30</option>
	<option value="14:00:00">14:00</option>
	<option value="14:30:00">14:30</option>
	<option value="15:00:00">15:00</option>
	<option value="15:30:00">15:30</option>
	<option value="16:00:00">16:00</option>
	<option value="16:30:00">16:30</option>
	<option value="17:00:00">17:00</option>
	<option value="17:30:00">17:30</option>
	<option value="18:00:00">18:00</option>
	<option value="18:30:00">18:30</option>
	<option value="19:00:00">19:00</option>
	<option value="19:30:00">19:30</option>
	<option value="20:00:00">20:00</option>
	<option value="20:30:00">20:30</option>
	<option value="21:00:00">21:00</option>
	<option value="21:30:00">21:30</option>
	<option value="22:00:00">22:00</option>
	<option value="22:30:00">22:30</option>
	<option value="23:00:00">23:00</option>
	<option value="23:30:00">23:30</option>
</select>
<br>
<br>
  <input type="submit" value="Submit Request for a Car pool "/>
<div id='err' style="color:red"></div>
</form>

<script language="javascript">
  function check()/*function to check userid & password*/
  {
          
          if(document.getElementById("SelectedDate").value.trim()==""){
          	document.getElementById('err').innerHTML="SelectDate";
          	return false;
          }
                              	
          return true;
  }
</script>
<script type="text/javascript" src="htmlDatePicker.js"></script>
</center>
</body>
</html>

