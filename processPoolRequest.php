<html>
<body>

<?php
   include 'configDB.php';
   session_start();
   $emailID = $_SESSION['email'];
   $username = $_POST['username']; 
   $src = $_POST['srcAddress'];
   $dest = $_POST['destAddress'];
   $departureTime1 = $_POST['date1'];
   $departureTime2 = " ".$_POST['time1'];
   $departureTime = $departureTime1." ".$departureTime2;
//   echo $departureTime;

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

  //  echo "Validate" . $query . "<br>";
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


    //echo $query;
    echo '<br>';
   $result2 = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
   
   $row = mysql_fetch_array($result2);

   //echo "I am here";

   $query = 'SELECT distinct car_owner.user_id,car_owner.available_seats,car_owner.departure_time FROM pool_requestor, car_owner

   WHERE 

   pool_requestor.user_id <>car_owner.user_id

   AND pool_requestor.destination = car_owner.destination 

   AND pool_requestor.current_location=car_owner.current_location 

   AND pool_requestor.request_status <> "CLOSED"

   AND car_owner.status <> "CLOSED"

   and car_owner.available_seats > 0

   and timestampdiff(minute,car_owner.departure_time,pool_requestor.departure_time) between -30 and 30
   order by pool_requestor.create_date desc';

    //echo $query;

   $result = mysql_query($query, $connect)
        or die('Error executing the query' . mysql_error());
 
    $num_rows = mysql_num_rows($result);
	
    //echo "No. of Rows = " . $num_rows . '<br>';
   while ($row = mysql_fetch_array($result)) {
      //  echo $row[0] . '   ' . $row[1] . '<br>' ;
        $car_owner_user_id = $row[0];
        $available_seats = $row[1];
        $car_ownerdeparture_time = $row[2];

        if ($available_seats == 1) {
            $available_seats = $available_seats - 1;
            $query1 = 'UPDATE `car_owner` SET `available_seats`=' . $available_seats .',
                    `status`="CLOSED" WHERE 
                user_id = '.$car_owner_user_id .' and current_location = "'. $src . '" and 
                destination = "' . $dest . '" and timestampdiff(minute, "' . $departureTime . '" , "' .
                $car_ownerdeparture_time .'") between -30 and 30 ';
        }
        else if ($available_seats > 1) {
            $available_seats = $available_seats - 1;
            $query1 = 'UPDATE `car_owner` SET `available_seats`=' . $available_seats .' WHERE 
                user_id = '.$car_owner_user_id .' and current_location = "'. $src . '" and 
                destination = "' . $dest . '" and timestampdiff(minute, "' . $departureTime . '" , "' .
                $car_ownerdeparture_time .'") between -30 and 30';
        }
        //echo "query1 : " .$query1;

        $result1 = mysql_query($query1, $connect)
                or die('Error executing the query' . mysql_error());
 
        $num_rows1 = mysql_num_rows($result1);

        $query1 = 'UPDATE `pool_requestor` SET `request_status`="CLOSED", `car_owner_id`='
                .$car_owner_user_id .',`request_update_time`=CURRENT_TIMESTAMP() WHERE 
                user_id = '.$poolRequestorUserid .' and  current_location = "'. $src . '" and 
                destination = "' . $dest . '" and departure_time = "' . $departureTime . '"
                ';
        $result1 = mysql_query($query1, $connect)
                or die('Error executing the query' . mysql_error());
 
        $num_rows1 = mysql_num_rows($result1);
        $flag = true;
        break;
   }
   if ($flag != true) {
        echo 'Your request has been noted. You will be notified once a car pool opens
            up on your route<br>';
        echo '<a href="welcome.php"> Welcome Page</a>';
        return;
   }
   echo '<table>';
   $query = 'select * from user_master where user_id = '. $car_owner_user_id;
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
            <br> Please find below the Car owner and Travel details.<br><br>
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
