<?php
session_start();
//display errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

//define number of columns in screen table
define('COLS', 6);
//set maximum number of records per page
define('SHOWMAX', 8);

//Establish type of user connection
	include('pdo_db_connect.inc.php');
	// remove backslashes
  	include('stripslash.inc.php');

nukeMagicQuotes(); // function from include to remove backslashes & quotes
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Search</title>
<link href="library.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="valid.js"></script>
<script type="text/javascript">
	$(document).ready(function( ) {
	startForm();
	$('tr:nth-child(odd)').addClass('odd');

});
</script>
</head>

<body>
<h1>Search the Filing System</h1>
<p><a href="screenfiler.php">SHOW ALL</a></p>
<div style="float:left; margin-right:20px;">
<h4>To look up by Title or Description:</h4>
   <form name="Find" action="wordsearch.php" method="post" id="Find" onsubmit="return checkTerm()" onreset="">
        <fieldset>
        <legend>Word Search:</legend>
		<div class="content">
		<div class="row">
			<div class="left"><label for="qproject">Enter Terms:</label></div>
			<div class="right"><input name="qproject" type="text" class="text" /></div>
			<div class="clear"></div>
		</div>
        <div class="row">
			<div class="left"> <input type="submit" name="submit" id="submit" value="Search" />
                <input type="reset" name="reset" id="reset" value="Clear" /></div>
			<div class="right"></div>
			<div class="clear"></div>
		</div>
		</div>
     </fieldset>
    </form>
</div>
<div style="float:left; margin-right:20px; clear:left;">
<h4>To look up by Number:</h4>
   <form name="numFind" action="numsearch.php" method="post" id="numFind" onsubmit="return checkInt()" onreset="">
        <fieldset>
        <legend>Number Search:</legend>
		<div class="content">
		<div class="row">
			<div class="left"><label for="qnum">Number:</label></div>
			<div class="right"><input name="qnum" type="text" class="text" /></div>
			<div class="clear"></div>
		</div>
        <div class="row">
			<div class="left"> <input type="submit" name="numsubmit" id="numsubmit" value="Search" />
                <input type="reset" name="reset" id="num_reset" value="Clear" /></div>
			<div class="right"></div>
			<div class="clear"></div>
		</div>
		</div>
     </fieldset>
    </form>
</div>
<div style="float:left; margin-right:20px; clear:left;">
<h4>To look up by Date:</h4>
   <form name="dateFind" action="datesearch.php" method="post" id="dateFind" onsubmit="return checkDate()" onreset="">
        <fieldset>
        <legend>Date Search:(Format YYYY-MM-DD)</legend>
		<div class="content">
		<div class="row">
			<div class="left"><label for="qdate">Date:</label></div>
			<div class="right"><input name="qdate" type="text" class="text" /></div>
			<div class="clear"></div>
		</div>
        <div class="row">
			<div class="left"> <input type="submit" name="datesubmit" id="datesubmit" value="Search" />
                <input type="reset" name="reset" id="date_reset" value="Clear" />
                </div>
			<div class="right"></div>
			<div class="clear"></div>
		</div>
		</div>
        <span class="required">Note: This search will retrieve all records up to the date entered...</span>
     </fieldset>
    </form>
</div>
</body>
</html>
