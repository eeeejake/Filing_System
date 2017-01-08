<?php
session_start();
if($_POST && !empty($_POST['qproject'])){
	//set session variable
	$_SESSION['submit']=$_POST['qproject'];
}
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

if($_SESSION['submit']){
  //if(preg_match("/^[0-9a-zA-Z \-\'\_\.]{2,40}$/", $_SESSION['submit'])){//causes problems on some versions of PHP escaping single quote
  	$qterm=$_SESSION['submit'];
	$q_term=addslashes($qterm);//to escape possible single quotes in SQL
  	//connect  to the database
	$conn = dbConnect('query');

	//prepare the SQL query for the db connection using PDO COUNT function
	//$sql = "SELECT COUNT(*) FROM library WHERE screen_name LIKE '%" . $qterm .  "%' OR screen_refs LIKE '%" . $qterm ."%'";
	//better?
	$sql = "SELECT COUNT(*), MATCH(screen_name, screen_refs, screen_notes) AGAINST('". $q_term ."') as score FROM library WHERE MATCH (screen_name, screen_refs, screen_notes) AGAINST('". $q_term ."') OR screen_name LIKE '%" . $q_term .  "%' OR screen_refs LIKE '%" . $q_term ."%' ORDER BY score DESC";

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

	//prepare SQL query
	//$getDetails = "SELECT screen_date, screen_number, screen_name, screen_refs, screen_notes FROM library WHERE screen_name LIKE '%" . $qterm .  "%' OR screen_refs LIKE '%" . $qterm ."%'";
	//better? This Way shows the match of multiple columns with a full text search and displays result by relevance
	$getDetails = "SELECT *, MATCH(screen_name, screen_refs, screen_notes) AGAINST('". $q_term ."') as score FROM library WHERE MATCH (screen_name, screen_refs, screen_notes) AGAINST('". $q_term ."') OR screen_name LIKE '%" . $q_term .  "%' OR screen_refs LIKE '%" . $q_term ."%' LIMIT ". $startRow.','.SHOWMAX;
	}
  	//}preg_match block
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filing System</title>
<?php
	include('./header_scripts.inc.php');
	//links for css, jquery, and javascript
	?>
</head>

<body>
<h1>Search Results</h1>
<p><?php
	if (isset($_SESSION['userok']) && isset($_SESSION['passwdok'])) {
		echo "<h4><span class='required'>LOGGED IN</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='login.php'>LOGOUT</a></h4>";
	}
	else{
		echo "<h4><span class='required'><a href='login.php'>LOGIN TO EDIT OR DELETE</span></a></h4>";

	}?>
</p>
<p><a href="screenfiler.php">SHOW ALL</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="search_db.php">NEW SEARCH</a></p>
<?php echo "<p>$numRows matching entries in the Library Database </p>"; ?>
<?php
	include('./table_output.inc.php');
	//generate table
	?>
</body>
</html>
