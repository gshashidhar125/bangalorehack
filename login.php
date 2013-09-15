<html>

<style type="text/css">
  body { background-size: 100%; }
</style>


	<head>
		<title>
			Login page
		</title>
	</head>
	
<body background="car.jpg">
<?php
    include 'configDB.php';
    include 'functions.inc.php';
    
    
    session_start();
    
    /*if (check_login_status() == true) {

        redirect('welcome.php');
    }*/

//    include 'checkLogin.php';
    if(!isset($_POST['email']))
        $email = "";
    else
        $email = $_POST['email'];

//    session_start();
    if ($email != "") {

        $password = $_POST['password'];
        $password = md5($password);
        $query = 'select email from user_master where email = "'
                . $email . '" && password = "' . $password . '"';

        $result = mysql_query($query, $connect)
            or die('Error executing the query' . mysql_error());
        $num_rows = mysql_num_rows($result);

        if ($num_rows == 0) {
            echo "Login Failed. Please Enter valid Credentials";
        }
        else{
            
            echo "Login Success";
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;
            redirect('welcome.php');
        }
    }
?>

	<center>
		<h1 style="font-family:Comic Sans Ms";text-align="center";font-size:20pt;
			color:#00FF00;>
			Car Pool<br> Login Page
		</h1>

		<form name="login" id='login' action='login.php' method="post">
			EMail-ID<input type="text" name="email" id="email"/></br>
			Password<input type="password" name="password"/></br></br>	
			<input type="submit" value="Login"/>
		</form>

        NewUser? <a href = "register.php">Register Here </a>
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
	</center>
</body>
</html>
