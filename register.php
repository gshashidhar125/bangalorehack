<html>

  <head>

  <title>Registration </title>

<center>
		<h1 style="font-family:Comic Sans Ms;text-align="center";font-size:20pt;
			color:#00FF00;>
			Car Pool<br> Registration Page
		</h1>
  </head>

  <style type="text/css">
    body { background-size: 100%; }
  </style>

  <body background="car.jpg">

	  <form name="reg_form" id="reg_form" method="post" id="frm" action="confirmation.php"
                onsubmit = "return validate()">

		  <table>

		  <tr><td colspan="2"><?php echo isset($_GET["msg"])?$_GET["msg"]:"";?>
		  </td></tr>

		  <tr><td>Name</td><td><input type="text" name="username" id="username" />
		  <span style="color:red" id='errusername'></span></td></tr>

		<tr><td>Email</td><td><input type="text" name="email" id="email" />
 		  <span style="color:red" id='erremail'></span></td></tr>

		<tr><td>Ph.No</td><td><input type="text" name="phno" id="phno" />
  		  <span style="color:red" id='errphno'></span></td></tr>

		<tr><td>Gender</td><td><select id="gender" name="gender">
			<option value="M">Male</option>
			<option value="F">Female</option>
		</select>
		  </td></tr>
		
		

		  <tr><td>Password</td><td><input type="password" name="password" id="password" />
		</td></tr>

		<tr><td>Confirm</td><td><input type="password" name="confirm" id="confirm" />
  	        <span style="color:red" id='errpass'></span></td></tr>
		<tr><td></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		
        <input type="submit" value ="Register">
		</td></tr>

		  </table>

	  </form>

        Already Registered? <a href = "login.php">Login Here </a>
  </center>
	</body>

	<script>
		function validate()
		{
			var flag=0;
			
			document.getElementById('errusername').innerHTML = "";
			document.getElementById('erremail').innerHTML = "";
			document.getElementById('errpass').innerHTML = "";
			document.getElementById('errphno').innerHTML = "";
			
			if(document.getElementById('username').value == ""){
  	     		  document.getElementById('errusername').innerHTML = "Cannot Be Blank";
			  flag=1;
			}
			
			if(document.getElementById('email').value.indexOf("@") < 1){			
  	     		  document.getElementById('erremail').innerHTML = "Invalid Email";
			  flag=1;
			}
		
			if(document.getElementById('password').value != document.getElementById('confirm').value){			
  	     		  document.getElementById('errpass').innerHTML = "Password Mismatch";
			  flag=1;			
			}
			
			if(document.getElementById('password').value.trim()=="" || document.getElementById('confirm').value.trim()=="")			{			
  	     		  document.getElementById('errpass').innerHTML = "Password Cannot be Blank";
			  flag=1;
			}
			
			 var phoneno = /^\d{10}$/;  

			var pvalid = document.getElementById('phno').value.match(phoneno); 
			if( pvalid == null){
			  document.getElementById('errphno').innerHTML = "Phone Number Invalid";
		   	  flag=1;				
			}
	
			if(flag==0){
			 // window.location="confirmation.php";
			 // form.submit();
             //   document.getElementById("frm").submit();
             return true;
			}
            return false;
		}
	</script>

  </html>
