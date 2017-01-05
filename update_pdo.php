<?php
//display errors
error_reporting(E_ALL);
ini_set('display_errors', '1');
//Establish type of user connection
require_once('pdo_db_connect.inc.php');
// remove backslashes
include('stripslash.inc.php');

// remove backslashes
nukeMagicQuotes();
// initialize flags
$OK = false;
$done = false;
 // create database connection
$conn = dbConnect('admin');
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
// if form has been submitted, update record
if (array_key_exists('update', $_POST)) {
  // prepare update query
  // shorter variables
  $id=$_POST['screen_id'];
  $number=$_POST['snum'];
  $project=$_POST['project'];
  $refs=$_POST['refs'];
  $notes=$_POST['notes'];
  $sql = 'UPDATE library SET screen_date = NOW(), screen_number = ?, screen_name = ?, screen_refs = ?, screen_notes = ?
          WHERE screen_id = ?';
  $stmt = $conn->prepare($sql);
  // execute query by passing array of variables

  $done = $stmt->execute(array($number, $project, $refs, $notes, $id));
  //original $done = $stmt->execute(array($_POST['sdate'], $_POST['snum'], $_POST['project'], $_POST['refs'],$_POST['notes']));
  }
// redirect on success or if $_GET['screen_id'] not defined
if ($done || !isset($_GET['screen_id'])) {
  header('Location: screenfiler.php');
  //alert on success
  exit;
  }
// display error message if query fails
if (isset($stmt) && !$OK && !$done) {
  $error = $stmt->errorInfo();
  if (isset($error[2])) {
    echo $error[2];
	}
  }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>library - update record</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="valid.js"></script>
</head>

<body>
<h1>Update the Filing System</h1>
<p><a href="screenfiler.php">List all entries</a> </p>
<?php if (!isset($screen_id)) {
?>
<p class="warning">Invalid request: record does not exist.</p>
<?php }
else {
?>
<div style="float:left; margin-right:20px;">
<h4>To EDIT information for an entry in the system, use this form.</h4>
   <form name="editform" action="" method="post"  id="editform" onsubmit="return checkUpdate()" onreset="window.history.back()">

        <fieldset>
        <legend>Edit An Entry:</legend>
        <div class="row">
			<div class="left"><label for="sdate">Last Modified:</label></div>
			<div class="right"><input name="sdate" type="text" class="text" value="<?php echo htmlentities($screen_date, ENT_COMPAT, 'utf-8'); ?>"/></div>
			<div class="clear"></div>
    		</div>
		<div class="row">
			<div class="left"><label for="snum">Number:</label></div>
			<div class="right"><input name="snum" type="text" class="text" value="<?php echo htmlentities($screen_number, ENT_COMPAT, 'utf-8'); ?>"/></div>
			<div class="clear"></div>
		</div>
		<div class="row">
			<div class="left"><label for="project">Project Title:</label></div>
			<div class="right"><input name="project" type="text" class="text" value="<?php echo htmlentities($screen_name, ENT_COMPAT, 'utf-8'); ?>"/></div>
			<div class="clear">
		</div>
		<div class="row">
			<div class="left"><label for="refs">Reference Words:</label></div>
			<div class="right"><input name="refs" type="text" class="text" value="<?php echo htmlentities($screen_refs, ENT_COMPAT, 'utf-8'); ?>"/></div>
			<div class="clear"></div>
		</div>

		<div class="row">
			<div class="left"><label for="notes">Notes:</label></div>
			<div class="right"><textarea name="notes" cols="22" rows="3"><?php echo htmlentities($screen_notes, ENT_COMPAT, 'utf-8'); ?></textarea></div>
			<div class="clear"></div>
		</div>
        <div class="row">
			<div class="left"> <input type="submit" name="update" id="update" value="Update" />
                <input type="reset" name="reset" id="reset" value="Cancel" /></div>
                <input name="screen_id" type="hidden" value="<?php echo $screen_id; ?>" />
			<div class="right"><span class="required">*Required Fields</span></div>
			<div class="clear"></div>
		</div>
		</div>
     </fieldset>
    </form>
</div>

<?php } ?>
</body>
</html>
