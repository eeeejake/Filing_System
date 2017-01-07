<?php
	include('prelude_php.inc.php');
	//code block repeated for authentication on multiple pages
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filing System</title>
<?php
	include('header_scripts.inc.php');
	//links for css, jquery, and javascript
	?>
</head>

<body>

<h1>Filing System</h1>
<p><?php
	if (isset($_SESSION['userok']) && isset($_SESSION['passwdok'])) {
		echo "<h4><span class='required'>LOGGED IN</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='login.php'>LOGOUT</a></h4>";
	}
	else{
		echo "<h4><span class='required'><a href='login.php'>LOGIN TO EDIT OR DELETE</span></a></h4>";

	}
	echo "There are currently $numRows entries in the Library Database ";?>
</p>
<p><a href="search_db.php">SEARCH</a><?php
	if (isset($_SESSION['userok']) && isset($_SESSION['passwdok'])) {
		echo "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='insert_pdo.php'>NEW ENTRY</a>";
	}
	?>
	&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Order_Calculator.html">ORDER CALCULATOR</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Blank_Price_Calculator.html">BLANK CALCULATOR</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Print_Price_Calculator.html">PRINT CALCULATOR</a>
	</p>

<?php
	include('./table_output.inc.php');
	//generate table
	?>
</body>
</html>
