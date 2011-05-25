<?php
include_once "common/common.php";

//initialize some arrays
$formInput = array("game", "serverName", "serverPass", "serverIP", "serverPort", "maxPlayers", "description");
$good = array();
$bad = array();
$inValid = array();
$valid = true;

//connection string - uncomment when ready
/*
	$con = mysql_connect($db_host, $db_user, $db_pwd);
	//test to see if you can connect to the DB
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
*/
	
//check if any variable's passed are null.
foreach ($formInput as $item) {
	if (isset($_POST[$item]) && $_POST[$item]!="") {
		$good[$item] = sanitizeInput($_POST["$item"], $mysqli);
	} else {
		$bad[$item] = sanitizeInput($_POST["$item"], $mysqli);
		$valid = false;	
	}
}


//validation code ////////////////////////////////////
//validate serverName
//validate description
//don't need this because...javascript will catch it?


//validate game
/*
if (array_key_exists('game', $good)) {
	if ($good['game'] == 0) {
		$inValid['game'] = $good['game'];	
		$valid = false;
	}
}
*/

//validate port
if (array_key_exists('serverPort', $good)) {
	if ($good['serverPort'] < 0 && $good['serverPort'] > 65535) {
		$inValid['serverPort'] = $good['serverPort'];	
		$valid = false;
	}	
}

//validate maxPlayers
if (array_key_exists('maxPlayers', $good)) {
	if (!$good['maxPlayers'] > 0) {
		$inValid['maxPlayers'] = $good['maxPlayers'];	
		$valid = false;
	}	
}


//input into database /////////////////////////////////////////////////
if ($valid) {


	// Where the file is going to be placed 
	$target_path = "uploads/";

	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename( $_FILES['image']['name']); 

	if(move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
		echo "The file ".  basename( $_FILES['image']['name']). 
		" has been uploaded";
	} else {
		echo "There was an error uploading the file, please try again!";
	}

	echo "inserting into the database <br />";
	//insert statement into server table
	$sql = "INSERT INTO servers (creatorID, game, serverName, serverPass, image, serverIP, serverPort, maxPlayers, whenCreated, description) VALUES
				('{$_SERVER["REMOTE_USER"]}',
				'{$good["game"]}', 
				'{$good["serverName"]}',
				'{$good["serverPass"]}',
				'{$target_path}',
				'{$good["serverIP"]}',
				{$good["serverPort"]},
				{$good["maxPlayers"]},
				CURDATE(), 
				'{$good["description"]}')";
	
	if (!$mysqli->query($sql))  
	{
		  // it failed, will not work
		  die('Error: ' . $mysqli->error);
		  }
} else {

echo <<<_END
	<h1>server registration is INCOMPLETE</h1>
	<div><h3>Thank you for applying, but you missed something</h3></div>
	<div>game: $good[game]</div>  <br />
	<div>server name: $good[serverName]</div>  <br />
	<div>server IP: $good[serverIP]</div>  <br />
	<div>server port: $good[serverPort]</div>  <br />
	<div>max player: $good[maxPlayers]</div>  <br />
	<div>description: $good[description]</div>  <br />
_END;
}
?>
