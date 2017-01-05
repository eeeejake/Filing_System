<?php
session_start();
if($_POST && !empty($_POST['qnum'])){
	//set session variable
	$_SESSION['numsubmit']=$_POST['qnum'];
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

if($_SESSION['numsubmit']){
  if(preg_match("/([Xx0-9-]+)/", $_SESSION['numsubmit'])){
  	$qnum=$_SESSION['numsubmit'];
  	//connect  to the database
	$conn = dbConnect('admin');

	//prepare the SQL query for the db connection using PDO COUNT function
	//select all columns where screen number is exactly equal to qnum
	$sql = "SELECT COUNT(*) FROM library WHERE screen_number = '" . $qnum ."'";

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
	//prepare SQL query
	//shows the match of number search and displays result by relevance
	$getDetails = "SELECT * FROM library WHERE screen_number = '" . $qnum ."' LIMIT ". $startRow.','.SHOWMAX;
	}
  	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filing System</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function( ) {
	$('tr:nth-child(odd)').addClass('odd');

});
</script>
</head>

<body>
<h1>Search Results</h1>
<p><?php
	if (isset($_SESSION['userok']) || isset($_SESSION['passwdok'])) {
		echo "<h4><span class='required'>LOGGED IN</span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='login.php'>LOGOUT</a></h4>";
	}
	else{
		echo "<h4><span class='required'><a href='login.php'>LOGIN TO EDIT OR DELETE</span></a></h4>";

	}?>
</p>
<p><a href="screenfiler.php">SHOW ALL</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="search_db.php">NEW SEARCH</a></p>
<?php echo "<p>$numRows matching entries in the Library Database </p>"; ?>
<table class="screenFile">
	<tr>
    	<th>Date</th>
        <th>Number</th>
        <th>Name</th>
        <th>References</th>
        <th>Notes</th>
        <th colspan="3">Modify</th>
	</tr>

<?php foreach ($conn->query($getDetails)as $row) { //retrieve screen data from db in tables?>
<?php
 //variables allow user to edit and delete if logged in as admin
if (isset($_SESSION['userok']) && isset($_SESSION['passwdok'])) {
	$editlink ="<a href='update_pdo.php?screen_id=".$row['screen_id'].";'>EDIT</a>";
	$deletelink="<a href='delete_pdo.php?screen_id=".$row['screen_id'].";'>DELETE</a>";
}
else {
	$editlink = "<span class='na'>EDIT</span>";
	$deletelink = "<span class='na'>DELETE</span>";
}
?>
	 <tr>
    	<td><?php echo $row['screen_date']; ?></td>
        <td><?php echo $row['screen_number']; ?></td>
        <td><?php echo $row['screen_name']; ?></td>
        <td><?php echo $row['screen_refs']; ?></td>
        <td><?php echo $row['screen_notes']; ?></td>
        <td><?php echo $editlink; ?></td>
        <td><?php echo $deletelink; ?></td>
        <td><a href="renew_pdo.php?screen_id=<?php echo $row['screen_id']; ?>">RENEW</a></td>
	</tr>
<?php } ?>
<!-- Navigation link here -->
		 <tr class = "navlink">
                <td class = "navlink"><?php
		    // create a back link if current page greater than 0
		    if ($curPage > 0) {
		        echo '<a href="'.$_SERVER['PHP_SELF'].'?curPage='.($curPage-1).'">&lt; Prev</a>';
			}
		     // otherwise leave the cell empty
		        else {
		        echo '&nbsp;';
			}
		        ?>
                    </td>
                    <?php
		            // pad the final row with empty cells if more than 2 columns
		            if (COLS-2 > 0) {
		            for ($i = 0; $i < COLS-2; $i++) {
			          echo '<td>&nbsp;</td>';
			          }
			        }
		            ?>
                    <td class = "navlink">
		    <?php
		        // create a forwards link if more records exist
		        if ($startRow+SHOWMAX < $totalResults) {
			    echo '<a href="'.$_SERVER['PHP_SELF'].'?curPage='.($curPage+1).'">Next &gt;</a>';
			          }
		            // otherwise leave the cell empty
		            else {
		              echo '&nbsp;';
			          }
		            ?>
                    </td>
                </tr>
</table>

</body>
</html>
