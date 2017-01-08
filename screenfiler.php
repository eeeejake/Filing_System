<?php
	include('./prelude_php.inc.php');
	//code block repeated for authentication on multiple pages
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

<h1>Filing System</h1>
<?php
	include('./menu.inc.php');
	//link nav
	?>
<?php
	include('./table_output.inc.php');
	//generate table
	?>
</body>
</html>
