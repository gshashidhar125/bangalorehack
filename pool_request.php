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

  ?>
  </select>
  </br></br>  
  Estimated Departure Time : <input type="text" size=5 name="SelectedDate" id="SelectedDate" readonly onClick="GetDate(this);" style="width: 100px;"/> 

<select name="time" id="time">
	<option value="5:00 AM">5:00 AM</option>
	<option value="5:15 AM">5:15 AM</option>
	<option value="5:30 AM">5:30 AM</option>
	<option value="5:45 AM">5:45 AM</option>
	
	<option value="6:00 AM">6:00 AM</option>
	<option value="6:15 AM">6:15 AM</option>
	<option value="6:30 AM">6:30 AM</option>
	<option value="6:45 AM">6:45 AM</option>
	
	<option value="7:00 AM">7:00 AM</option>
	<option value="7:15 AM">7:15 AM</option>
	<option value="7:30 AM">7:30 AM</option>
	<option value="7:45 AM">7:45 AM</option>
	
	<option value="8:00 AM">8:00 AM</option>
	<option value="8:15 AM">8:15 AM</option>
	<option value="8:30 AM">8:30 AM</option>
	<option value="8:45 AM">8:45 AM</option>
	
	<option value="9:00 AM">9:00 AM</option>
	<option value="9:15 AM">9:15 AM</option>
	<option value="9:30 AM">9:30 AM</option>
	<option value="9:45 AM">9:45 AM</option>
	
	<option value="10:00 AM">10:00 AM</option>
	<option value="10:15 AM">10:15 AM</option>
	<option value="10:30 AM">10:30 AM</option>
	<option value="10:45 AM">10:45 AM</option>
	
	<option value="11:00 AM">11:00 AM</option>
	<option value="11:15 AM">11:15 AM</option>
	<option value="11:30 AM">11:30 AM</option>
	<option value="11:45 AM">11:45 AM</option>
	
	<option value="12:00 PM">12:00 PM</option>
	<option value="12:15 PM">12:15 PM</option>
	<option value="12:30 PM">12:30 PM</option>
	<option value="12:45 PM">12:45 PM</option>
	
	<option value="1:00 PM">1:00 PM</option>
	<option value="1:15 PM">1:15 PM</option>
	<option value="1:30 PM">1:30 PM</option>
	<option value="1:45 PM">1:45 PM</option>
	
	<option value="2:00 PM">2:00 PM</option>
	<option value="2:15 PM">2:15 PM</option>
	<option value="2:30 PM">2:30 PM</option>
	<option value="2:45 PM">2:45 PM</option>
	
	<option value="3:00 PM">3:00 PM</option>
	<option value="3:15 PM">3:15 PM</option>
	<option value="3:30 PM">3:30 PM</option>
	<option value="3:45 PM">3:45 PM</option>
	
	<option value="4:00 PM">4:00 PM</option>
	<option value="4:15 PM">4:15 PM</option>
	<option value="4:30 PM">4:30 PM</option>
	<option value="4:45 PM">4:45 PM</option>
	
	<option value="5:00 PM">5:00 PM</option>
	<option value="5:15 PM">5:15 PM</option>
	<option value="5:30 PM">5:30 PM</option>
	<option value="5:45 PM">5:45 PM</option>
	
	<option value="6:00 PM">6:00 PM</option>
	<option value="6:15 PM">6:15 PM</option>
	<option value="6:30 PM">6:30 PM</option>
	<option value="6:45 PM">6:45 PM</option>
	
	<option value="7:00 PM">7:00 PM</option>
	<option value="7:15 PM">7:15 PM</option>
	<option value="7:30 PM">7:30 PM</option>
	<option value="7:45 PM">7:45 PM</option>
	
	<option value="8:00 PM">8:00 PM</option>
	<option value="8:15 PM">8:15 PM</option>
	<option value="8:30 PM">8:30 PM</option>
	<option value="8:45 PM">8:45 PM</option>
	
	<option value="9:00 PM">9:00 PM</option>
	<option value="9:15 PM">9:15 PM</option>
	<option value="9:30 PM">9:30 PM</option>
	<option value="9:45 PM">9:45 PM</option>
	
	<option value="10:00 PM">10:00 PM</option>
	<option value="10:15 PM">10:15 PM</option>
	<option value="10:30 PM">10:30 PM</option>
	<option value="10:45 PM">10:45 PM</option>
	
	<option value="11:00 PM">11:00 PM</option>
	<option value="11:15 PM">11:15 PM</option>
	<option value="11:30 PM">11:30 PM</option>
	<option value="11:45 PM">11:45 PM</option>
</select>
<br>
  <input type="text" name="departureTime" id="departureTime"/>
  <input type="submit" value="Submit Request for a Car pool "/>
</form>

<script language="javascript">
  function check(form)/*function to check userid & password*/
  {
          return false;
  }
</script>
<script type="text/javascript" src="htmlDatePicker.js"></script>
</center>
</body>
</html>

