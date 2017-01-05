<?php
//Establish type of user connection
include('pdo_db_connect.inc.php');
// remove backslashes
include('stripslash.inc.php');
nukeMagicQuotes(); // function from include to remove backslashes & quotes
 // create database connection
$conn = dbConnect('query');
// initialize flags
$OK = false;
$renewed = false;
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
if (array_key_exists('renew', $_POST)) {
  $sql = 'UPDATE library SET screen_date = NOW() WHERE screen_id = ?';
  $stmt = $conn->prepare($sql);
  $renewed = $stmt->execute(array($_POST['screen_id']));
  }
// redirect the page if deleted, cancel button clicked, or $_GET['screen_id'] not defined
if ($renewed || array_key_exists('cancel_renewal', $_POST) || !isset($_GET['screen_id']))  {
  header('Location: screenfiler.php');
  exit;
  }
// if any SQL query fails, display error message
if (isset($stmt) && !$OK && !$renewed) {
  $error = $stmt->errorInfo();
  if (isset($error[2])) {
    echo $error[2];
    }
  }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Filing System - renew record</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="valid.js"></script>
</head>

<body>
<h1>Renew Entry</h1>
<p><a href="screenfiler.php">SHOW ALL</a></p>
<?php if (!isset($screen_id)) { ?>
<p class="warning">Invalid request: record does not exist.</p>
<?php } else { ?>
<p class="warning">Please confirm that you want to renew the following item. This action cannot be undone.</p>
<p>
<?php echo "NAME: $screen_name".'<br />NUMBER: '.htmlentities($screen_number). "<br />DATE LAST MODIFIED: $screen_date"; ?></p>
<?php } ?>
<form id="renewform" name="renewform" method="post" action="" onsubmit="return confirmUpdate()" onreset="window.history.back()">
    <p>
	<?php if (isset($screen_id)) { ?>
        <input type="submit" name="renew" value="Confirm renewal" />
	<?php } ?>
		<input name="cancel_renewal" type="reset" id="cancel_renewal" value="Cancel" />
	<?php if (isset($screen_id)) { ?>
		<input name="screen_id" type="hidden" value="<?php echo $row['screen_id']; ?>" />
	<?php } ?>
    </p>
</form>
</body>
</html>
