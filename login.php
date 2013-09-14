<html>
	<head>
		<title>
			Login page
		</title>
	</head>
	
<body>
<?php
    include 'configDB.php';
//    include 'checkLogin.php';
    if(!isset($_POST['userID']))
        $userID = "";
    else
        $userID = $_POST['userID'];

//    session_start();
    if ($userID != "") {

        $password = $_POST['password'];
        $password = md5($password);
        $query = 'select user_ID from user_master where user_id = "'
                . $userId . '" && password = "' . $password . '"';

        $result = mysql_query($query, $connect)
            or die('Error executing the query' . mysql_error());
        $num_rows = mysql_num_rows($result);

        if ($num_rows == 0) {
            echo "Login Failed. Please Enter valid Credentials";
        }
    }
?>

	<center>
		<h1 style="font-family:Comic Sans Ms;text-align="center";font-size:20pt;
			color:#00FF00;>
			Car Pool<br> Login Page
		</h1>

		<form name="login" id='login' action='login.php' method="post">
			Username<input type="text" name="userID" id="userID"/></br>
			Password<input type="password" name="password"/></br></br>	
			<input type="submit" value="Login"/>
			<input type="button" value="Sign Up"/>
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
	</center>
</body>
</html>
