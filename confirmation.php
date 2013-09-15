<html>
	<body>
		<?php
		    include 'configDB.php';
		    include 'functions.inc.php';
		    session_start();
		    $email =  $_POST['email'];
		    $username =  $_POST['username'];
		    $phno =  $_POST['phno'];
		    $gender =  $_POST['gender'];
    		    $password =  $_POST['password'];
		    $password = md5($password);

		    $query = "SELECT * FROM `user_master` WHERE email='".$email."'";
		    $result = mysql_query($query, $connect)
            				or die('Error executing the query' . mysql_error());
			
		    $num_rows = mysql_num_rows($result);
	

		    if( $num_rows == 0 )
		    {
			    $query = "INSERT INTO `user_master`(`name`, `email`, `contact_num`, `gender`, `password`) VALUES ('".
				      $username."','".$email."',".$phno.",'".$gender."','".$password."')";
			  
		            $result = mysql_query($query, $connect)
		    				or die('Error executing the query' . mysql_error());
			    echo "Register Success : ";	
			
		    }
		    else
			echo " User Already Exists : ";			
		    	
		?>
		<a href="login.php">Click Here to Login</a>
	
	</body>
</html>
