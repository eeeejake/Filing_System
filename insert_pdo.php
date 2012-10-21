<?php
if (array_key_exists('file', $_POST)) {
	//Establish type of user connection
	include('pdo_db_connect.inc.php');
	// remove backslashes
  	include('stripslash.inc.php');
  
  nukeMagicQuotes(); // function from include to remove backslashes
  // initialize flag
  $OK = false;
  // create database connection
  $conn = dbConnect('admin');
  // create SQL
  $sql = 'INSERT INTO library (screen_date, screen_number, screen_name, screen_refs, screen_notes) 
          VALUES(NOW(), :number, :name, :refs, :notes)';
  // prepare the statement
  $stmt = $conn->prepare($sql);
  // bind the parameters and execute the statement
  $stmt->bindParam(':number', $_POST['snum'], PDO::PARAM_INT);
  $stmt->bindParam(':name', $_POST['sname'], PDO::PARAM_STR);
  $stmt->bindParam(':refs', $_POST['refs'], PDO::PARAM_STR);
  $stmt->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
  $OK = $stmt->execute();
  // redirect if successful or display error
  if ($OK) {
	header('Location: screenfiler.php');
    exit;
    }
  else {
    $error = $stmt->errorInfo();
	echo $error[2];
	}
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Screen Database - insert new record</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="valid.js"></script>
</head>

<body onload="newForm()">
<div style="float:left; margin-right:20px;">  
<h4>Add a screen to the Database</h4>
<p><a href="screenfiler.php">SHOW ALL SCREENS</a></p>
   <form name="addFile" action="#" method="post"  id="addFile" onsubmit="return checkScreen()" onreset="window.history.back()">
  
        <fieldset> 
        <legend>File A Screen:</legend>     
		<div class="row">
			<div class="left"><label for="snum">Screen Number:&nbsp;&nbsp;<span class = "required">*</span></label></div>
			<div class="right"><input name="snum" type="text" class="text" /></div>
			<div class="clear"></div>
		</div>
		<div class="row">
			<div class="left"><label for="sname">Project Title:&nbsp;&nbsp;<span class = "required">*</span></label></div>
			<div class="right"><input name="sname" type="text" class="text" /></div>
			<div class="clear">
		</div>
		<div class="row">
			<div class="left"><label for="refs">Reference Words:</label></div>
			<div class="right"><input name="refs" type="text" class="text" /></div>
			<div class="clear"></div>
		</div>

		<div class="row">
			<div class="left"><label for="notes">Notes:</label></div>
			<div class="right"><textarea name="notes" cols="22" rows="3"></textarea></div>
			<div class="clear"></div>
		</div>
        <div class="row">
			<div class="left"> <input type="submit" name="file" id="file" value="File" />
                <input type="reset" name="reset" id="reset" value="Cancel" /></div>
			<div class="right"><span class="required">*Required Fields</span></div>
			<div class="clear"></div>
		</div>
		</div>               
     </fieldset>             
    </form> 
</div>
</body>
</html>
