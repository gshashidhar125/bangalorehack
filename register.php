<html>

  <head>

  <title>Registration </title>

<center>
		<h1 style="font-family:Comic Sans Ms;text-align="center";font-size:20pt;
			color:#00FF00;>
			Car Pool<br> Registration Page
		</h1>
  </head>

  <body>

	  <form name="reg_form" id="reg_form" method="post" action="confirm.php">

		  <table>

		  <tr><td colspan="2"><?php echo isset($_GET["msg"])?$_GET["msg"]:"";?>
		  </td></tr>

		  <tr><td>Username</td><td><input type="text" name="username" id="username" />
		  </td></tr>

		<tr><td>Email</td><td><input type="text" name="email" id="email" />
		  </td></tr>

		<tr><td>Ph.No</td><td><input type="text" name="phno" id="phno" />
		  </td></tr>

		<tr><td>Gender</td><td><select id='gender'>
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>
		  </td></tr>
		
		

		  <tr><td>Password</td><td><input type="password" name="password" id="password" />
		</td></tr>

		<tr><td>Confirm</td><td><input type="password" name="confirm" id="confirm" />
		</td></tr>
		<tr><td></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="btnsubmit" id="btnsubmit" value="Register"/></td></tr>

		  </table>

	  </form>

  </center>
	</body>

  </html>
