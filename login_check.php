<?php	
//Establish type of user connection
	include('pdo_db_connect.inc.php');
	// remove backslashes
  	include('stripslash.inc.php');

	nukeMagicQuotes(); // function from include to remove backslashes & quotes
	//process the form only if submitted
if(array_key_exists('login', $_POST)){
	session_start(); 
	//connect as user to db with function
	$conn = dbConnect('query');

	//user authentication check for administration
	// Define $myusername and $mypassword
	$myusername=$_POST['user'];
	$mypassword=$_POST['passwd'];
	
	$idcheck="SELECT * FROM logon WHERE username='$myusername' and password='$mypassword'";
	$result=$conn->query($idcheck);

	//$count=mysql_num_rows($result);
	
	$error = $conn->errorInfo();
	if (isset($error[2])) die($error[2]);
	
	//find out how many records retrieved
	$count = $result->fetchColumn();
	
	$totalResults = $count;
	//free the database resources
	$result->closeCursor();
	
	// If result matched $myusername and $mypassword, table row must be 1 row

	if($count==1){
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	$_SESSION['userok']=$myusername;	
	$_SESSION['passwdok']=$mypassword;
	header("location:screenfiler.php");
	}
	else {
	echo "<h2 class='required'>Wrong Username or Password</h2>";
	session_destroy();
	//header("location:login.php");
	}

	ob_end_flush();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Screen Library Admin Login</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<body>
<h3>You Wrote:</h3>
<p>
<?php echo "User name: $myusername" ?>
</p>
<p>
<?php echo "Password: $mypassword" ?>
</p>
<a href="login.php"><< LOGIN</a>
</body>
</html>