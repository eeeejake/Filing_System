<?php
session_start();
ob_start();

//display errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

//define number of columns in screen table
define('COLS', 8);
//set maximum number of records per page
define('SHOWMAX', 10);

//Establish type of user connection
	include('pdo_db_connect.inc.php');
	// remove backslashes
  	include('stripslash.inc.php');

nukeMagicQuotes(); // function from include to remove backslashes & quotes
	//connect as user to db with function
	$conn = dbConnect('admin');

	//prepare the SQL query for the db connection using PDO COUNT function
	$sql = 'SELECT COUNT(*) from library';

	//submit the query and capture the result
	$result = $conn->query($sql);
	$error = $conn->errorInfo();
	if (isset($error[2])) die($error[2]);

	//find out how many records retrieved
	$numRows = $result->fetchColumn();

	$totalResults = $numRows;
	//free the database resources
	$result->closeCursor();
	//set the current page
    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 0;
    //calculate the start row of the subset
    $startRow = $curPage * SHOWMAX;

	//prepare second SQL query
	$getDetails = "SELECT * FROM library ORDER BY screen_name LIMIT $startRow,".SHOWMAX;
	?>
