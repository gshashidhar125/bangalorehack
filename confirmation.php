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

		    $query = "INSERT INTO `user_master`(`name`, `email`, `contact_num`, `gender`, `password`) VALUES ('".
			      $username."','".$email."',".$phno.",'".$gender."','".$password."')";
		  
                    $result = mysql_query($query, $connect)
            				or die('Error executing the query' . mysql_error());
		    echo "Sign Up Success.. you will be redirected to login page";	
			
		    sleep(15);

		    redirect('login.php');
		    	
		?>
		
	
	</body>
</html>
