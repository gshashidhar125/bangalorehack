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


<form name="newpoolrequest" id='newpoolrequest' action='processPoolRequest.php' method="post">
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
  Estimated Departure Time : <input type="text" size=5 name="SelectedDate" id="SelectedDate" readonly onClick="GetDate(this);" style="width: 100px;"/> <br>
  <input type="text" name="departureTime" id="departureTime"/>
  <input type="submit" value="Submit Request for a Car pool "/>
</form>

<script language="javascript">
  function check(form)/*function to check userid & password*/
  {
  /*the following code checkes whether the entered userid and password are matching*/
  
  if(form.userid.value == "myuserid" && form.pswrd.value == "mypswrd")
  {
  window.open('target.html')/*opens the target page while Id & password matches*/
  }
  else
  {
  alert("Error Password or Username")/*displays error message*/
  }
  }
</script>
<script type="text/javascript" src="htmlDatePicker.js"></script>
</center>
</body>
</html>

