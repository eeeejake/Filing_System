<?php function dbConnect($type) {//defines connection to database with PDO
  if ($type  == 'query') {
    $user = 'query';
	$pwd = 'logon';
	}
  elseif ($type == 'admin') {
    $user = 'admin';
	$pwd = 'logon';
	}
  else {
    exit('Unrecognized connection type');
	}
  try {
    $conn = new PDO('mysql:host=localhost;dbname=library', $user, $pwd);
    return $conn;
	}
  catch (PDOException $e) {
    echo 'Cannot connect to database';
	exit;
	}
    }
//MySQLI version
/*function dbConnect($type) {
  if ($type  == 'query') {
    $user = 'jacobsc1_squery';
	$pwd = 'Type_0_Negative@';
	}
  elseif ($type == 'admin') {
    $user = 'jacobsc1_sadmin';
	$pwd = 'Type_0_Negative@';
	}
  else {
    exit('Unrecognized connection type');
	}
  $conn = new mysqli('localhost', $user, $pwd, 'jacobsc1_library') or die ('Cannot open database');
  return $conn;
  }*/
	?>
