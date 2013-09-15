<html>
	<body>
		<?php
		    include 'configDB.php';
		    session_start();
		    $email =  $_POST['email'];
		    $username =  $_POST['username'];
		    $phno =  $_POST['phno'];
		    $gender =  $_POST['gender'];
    		    $password =  $_POST['password'];

		    $query = "INSERT INTO `user_master`(`name`, `email`, `contact_num`, `gender`, `password`) VALUES ('".
			      $username."','".$email."',".$phno.",'".$gender."','".$password."')";
		  
                    echo $query;

		?>
	
	</body>
</html>
