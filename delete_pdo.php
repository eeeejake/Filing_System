<?php
//This script will process the deletion of an entry from the database, in this case a specific silk screen database
//Establish type of user connection
include('pdo_db_connect.inc.php');
// remove backslashes
include('stripslash.inc.php');
nukeMagicQuotes(); // function from include to remove backslashes & quotes
 // create database connection
$conn = dbConnect('admin');
// initialize flags
$OK = false;
$deleted = false;
// get details of selected record
if (isset($_GET['screen_id']) && !$_POST) {
  // prepare SQL query
  $sql = 'SELECT * FROM library WHERE screen_id = ?';
  $stmt = $conn->prepare($sql);
  // execute query by passing array of variables
  $OK = $stmt->execute(array($_GET['screen_id']));
  // fetch the result
  $row = $stmt->fetch();
  // assign result array to variables
  if (is_array($row)) {
    extract($row);
	}
  }
// if confirm deletion button has been clicked, delete record
if (array_key_exists('delete', $_POST)) {
  $sql = 'DELETE FROM library WHERE screen_id = ?';
  $stmt = $conn->prepare($sql);
  $deleted = $stmt->execute(array($_POST['screen_id']));
  }
// redirect the page if deleted, cancel button clicked, or $_GET['screen_id'] not defined
if ($deleted || array_key_exists('cancel_delete', $_POST) || !isset($_GET['screen_id']))  {
  header('Location: screenfiler.php');
  exit;
  }
// if any SQL query fails, display error message
if (isset($stmt) && !$OK && !$deleted) {
  $error = $stmt->errorInfo();
  if (isset($error[2])) {
    echo $error[2];
    }
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Filing System - delete record</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="valid.js"></script>
</head>

<body>
<h1>Delete an Entry</h1>
<p><a href="screenfiler.php">SHOW ALL</a></p>
<?php if (!isset($screen_id)) { ?>
<p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<p class="warning">Please confirm that you want to delete the following item. This action cannot be undone.</p>
<p>
<?php echo "NAME: $screen_name".'<br />NUMBER: '.htmlentities($screen_number). "<br />DATE LAST MODIFIED: $screen_date"; ?></p>
<?php } ?>
<form id="deleteform" name="deleteform" method="post" action="" onsubmit="return confirmUpdate()" onreset="window.history.back()">
    <p>
	<?php if (isset($screen_id)) { ?>
        <input type="submit" name="delete" value="Confirm deletion" />
	<?php } ?>
		<input name="cancel_delete" type="reset" id="cancel_delete" value="Cancel" />
	<?php if (isset($screen_id)) { ?>
		<input name="screen_id" type="hidden" value="<?php echo $row['screen_id']; ?>" />
	<?php } ?>
    </p>
</form>
</body>
</html>
