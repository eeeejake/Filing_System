<?php function dbConnect($type) {//defines connection to database with PDO 
  if ($type  == 'query') {
    $user = 'username';
	$pwd = 'password';
	}
  elseif ($type == 'admin') {
    $user = 'admin username';
	$pwd = 'admin passwork';
	}
  else {
    exit('Unrecognized connection type');
	}
  try {
    $conn = new PDO('mysql:host=localhost;dbname=database_name', $user, $pwd);
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