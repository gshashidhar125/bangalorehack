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
		    echo $email.$username.$phno.$gender.$password;
		?>
	
	</body>
</html>
