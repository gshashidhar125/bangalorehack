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
   $total_seats = $_POST['TotalAvailableSeats'];

    echo "Src : " . $src;

   $query = 'select user_id from user_master where email = "' . $emailID . '"'; 

   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result);
    $num_rows = mysql_num_rows($result);
    if ($num_rows == 0) {
        echo "You are not registered with us";
        return;
    }
   $poolCreatorUserid = $row[0];
   
   
   $query = 'select * from car_owner where user_id = ' . $poolCreatorUserid . ' and current_location = "' . $src . '" and 
            destination = "' . $dest . '" and timestampdiff(minute, "' . $departureTime . '", car_owner.departure_time) between
            -30 and 30';

    //echo "Validate" . $query . "<br>";
   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result);
    $num_rows = mysql_num_rows($result);
    if ($num_rows != 0) {
        echo "Service already exists <br><br>";
        echo '<a href = "welcome.php">Return to Main Page</a>';
        return;
    }
    $query = '
    INSERT INTO `niyut`.`car_owner` (`user_id`, `current_location`, `destination`, `departure_time`, `total_seats`, `available_seats`, `status`, `create_date`) VALUES (' . $poolCreatorUserid . ', "' .$src . '", "' . $dest . '", "' . $departureTime . '", ' . $total_seats . ', ' . $total_seats . ', "OPEN", CURRENT_TIMESTAMP)';


    //echo $query;
    echo '<br>';
   $result2 = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result2);

   //echo "I am here";

/*   $query = 'SELECT * FROM pool_requestor, car_owner

   WHERE 

   pool_requestor.user_id <>car_owner.user_id

   AND pool_requestor.destination = car_owner.destination 

   AND pool_requestor.current_location=car_owner.current_location 

   AND pool_requestor.request_status <> "CLOSED"

   AND car_owner.status <> "CLOSED"

   and timestampdiff(minute,car_owner.departure_time,pool_requestor.departure_time) between -30 and 30';

    echo $query;

   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
 
    $num_rows = mysql_num_rows($result);
	
    echo "No. of Rows = " . $num_rows . '<br>';
   while ($row = mysql_fetch_array($result))
        echo $row[0] . '<br>' ;
*/
   $query = 'select * from user_master where user_id = '. $poolCreatorUserid;
    $result = mysql_query($query, $connect)
          or die('Error executing the query' . mysql_error());
 
    $num_rows = mysql_num_rows($result);
   $row = mysql_fetch_array($result);
   $name = $row[1];
   $phone = $row[3];
    echo 'We have confirmed you of your Car - Pool with ' . $name . 'whose Phone number is
        '.$phone ;
   echo '</table>';

    $to = 'gshashidhar125@gmail.com';
    $subject = 'Welcome to Niyut Car Pooling service';
    $body = 'Your Car Pooling request has been completed successfully.
            The Below user has been granted car pool request<br>'.$username.'
            <br> Please find below the Car Pooler and Travel details.<br><br>
            Car Owner: ' . $name .' <br> Phone Number: ' . $phone;
        $headers = "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
            "From: Yogeesh R<malumani@gmail.com>" . "\r\n";// .
            "Reply-To: yogeesh.srkvs@gmail.com" . "\r\n";// .

/*        echo 'To : ' . $to . '<br />';
        echo 'Subject: ' . $subject . '<br />';
        echo 'Body: ' . $body . '<br />';
*/
        $ret = mail($to, $subject, $body, $headers);
//        echo "Ret: " . $ret . "<br />";
?>
</body>


</html>
