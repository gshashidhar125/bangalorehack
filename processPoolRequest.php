<html>
<body>

<?php
   include 'configDB.php';
   session_start();
   $emailID = $_SESSION['email'];
   $username = $_POST['username']; 
   $src = $_POST['srcAddress'];
   $dest = $_POST['destAddress'];
   $departureTime = $_POST['departureTime'];


   $query = 'select user_id from user_master where email = "' . $emailID . '"'; 

   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result);
    $num_rows = mysql_num_rows($result);
    if ($num_rows == 0) {
        echo "You are not registered with us";
        return;
    }
   $poolRequestorUserid = $row[0];
   
   
   $query = 'select * from pool_requestor where user_id = ' . $poolRequestorUserid . ' and current_location = "' . $src . '" and 
            destination = "' . $dest . '" and timestampdiff(minute, "' . $departureTime . '", pool_requestor.departure_time) between
            -30 and 30';

    echo "Validate" . $query . "<br>";
   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result);
    $num_rows = mysql_num_rows($result);
    if ($num_rows != 0) {
        echo "Request already exists <br><br>";
        echo '<a href = "welcome.php">Return to Main Page</a>';
        return;
    }
    $query = '
    INSERT INTO `niyut`.`pool_requestor` (`user_id`, `current_location`, `destination`, `departure_time`, `request_status`, `create_date`, `car_owner_id`, `request_update_time`) VALUES (' . $poolRequestorUserid . ', "' .$src . '", "' . $dest . '", "' . $departureTime . '", "OPEN", CURRENT_TIMESTAMP, -999, "0000-00-00 00:00:00")';


    echo $query;
    echo '<br>';
   $result2 = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result2);

   //echo "I am here";

   $query = 'SELECT distinct car_owner.user_id,car_owner.available_seats  FROM pool_requestor, car_owner

   WHERE 

   pool_requestor.user_id <>car_owner.user_id

   AND pool_requestor.destination = car_owner.destination 

   AND pool_requestor.current_location=car_owner.current_location 

   AND pool_requestor.request_status <> "CLOSED"

   AND car_owner.status <> "CLOSED"

   and timestampdiff(minute,car_owner.departure_time,pool_requestor.departure_time) between -30 and 30
   order by pool_requestor.create_date desc';

    echo $query;

   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
 
    $num_rows = mysql_num_rows($result);
	
    echo "No. of Rows = " . $num_rows . '<br>';
   while ($row = mysql_fetch_array($result))
        echo $row[0] . '   ' . $row[1] . '<br>' ;

?>
</body>
</html>