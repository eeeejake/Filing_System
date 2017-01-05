<?php
session_start();
//end session to logout
if (isset($_SESSION['userok']) || isset($_SESSION['passwdok'])) {
	session_destroy();
}

//display errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

//define number of columns in screen table
define('COLS', 6);
//set maximum number of records per page
define('SHOWMAX', 10);

//Establish type of user connection
	include('pdo_db_connect.inc.php');
	// remove backslashes
  	include('stripslash.inc.php');

nukeMagicQuotes(); // function from include to remove backslashes & quotes
	//connect as user to db with function
	$conn = dbConnect('query');

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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filing System Admin Login</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">></script>
<script type="text/javascript">
	$(document).ready(function( ) {
	//stripe table
	$('tr:nth-child(odd)').addClass('odd');

	//swap arrow images on hover
	 $('#logarrow').bind("mouseenter mouseleave", function() {
      var src = ($(this).attr("src") === "arrow.jpg")
                    ? "arrow_blk.jpg"
                    : "arrow.jpg";
      $(this).attr("src", src);
	});

	//show and hide login menu
	$('#logarrow').click(function() {
  		$('#loginform').slideToggle('slow', function() {
    	// Animation complete.
  		});
	});

});
</script>
<script type="text/javascript">
function checkForm() {//validates login form
        var Pass = document.getElementById("user");
		if((document.admin.user.value.length < 3) || (document.admin.passwd.value.length < 3))
				{
                alert("Entry not accepted, please fill required fields");
				Pass.focus();
				return false;
				document.location.reload();
                }
				else return true;
}
</script>
</head>

<body>
<h1>Filing System</h1>

<p class="required">Please log in to access Administration:&nbsp; <img id="logarrow" src="arrow.jpg"/></p>
<div id="loginform">
		<form action="login_check.php" method="post" name="admin" id="admin" onsubmit="return checkForm()">
        		<p class="compact"><label for="user">User Name:</label>&nbsp;&nbsp;&nbsp;
                <input type="text" name="user" id="user" />&nbsp;&nbsp;&nbsp;<span class="required">*</span>
                </p>
                <p class="compact"><label for="passwd">Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="passwd" id="passwd" />&nbsp;&nbsp;&nbsp;<span class="required">*</span>
                </p>
                <p class="compact">
                <input type="submit" name="login" id="login" value="Log In" />
                <input type="reset" name="reset" id="reset" value="Clear" />
                &nbsp;&nbsp;&nbsp;<span class="required">*Required Fields</span>
                </p>
        </form>
</div>
<?php echo "There are currently $numRows entries in the Library Database ";?>
<p><a href="search_db.php">SEARCH</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Order_Calculator.html">ORDER CALCULATOR</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Blank_Price_Calculator.html">BLANK CALCULATOR</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="SC_Price_Generators/Print_Price_Calculator.html">PRINT CALCULATOR</a></p>
<table class="screenFile">
	<tr>
    	<th>Date</th>
        <th>Number</th>
        <th>Name</th>
        <th>References</th>
        <th>Notes</th>
        <th colspan="3">Modify</th>
	</tr>


<?php
 foreach ($conn->query($getDetails)as $row) { ?>
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
