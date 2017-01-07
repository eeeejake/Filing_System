<?php
	include('prelude_php.inc.php');
	//code block repeated for authentication on multiple pages
	//end session to logout
	if (isset($_SESSION['userok']) || isset($_SESSION['passwdok'])) {
		session_destroy();
		header("location:screenfiler.php");
	}
	?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Filing System Admin Login</title>
<?php
	include('header_scripts.inc.php');
	//links for css, jquery, and javascript
	?>
<script type="text/javascript">
		$(document).ready(function( ) {
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
		<?php
			include('./table_output.inc.php');
			//generate table
			?>
</body>
</html>
