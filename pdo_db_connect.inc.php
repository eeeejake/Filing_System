<?php function dbConnect($type) {
  if ($type  == 'query') {
    $user = 'shirtcir_squery';
	$pwd = 'webeshirts';
	}
  elseif ($type == 'admin') {
    $user = 'shirtcir_sadmin';
	$pwd = 'webeshirts2';
	}
  else {
    exit('Unrecognized connection type');
	}
  try {
    $conn = new PDO('mysql:host=localhost;dbname=shirtcir_screenfile', $user, $pwd);
    return $conn;
	}
  catch (PDOException $e) {
    echo 'Cannot connect to database';
	exit;
	}
    }
/*MySQLI version
function dbConnect($type) {
  if ($type  == 'query') {
    $user = 'squery';
	$pwd = 'webeshirts';
	}
  elseif ($type == 'admin') {
    $user = 'sadmin';
	$pwd = 'webeshirts2';
	}
  else {
    exit('Unrecognized connection type');
	}
  $conn = new mysqli('localhost', $user, $pwd, 'shirtcir_screenfile') or die ('Cannot open database');
  return $conn;
  }*/
	?>