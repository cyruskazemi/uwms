<?php

$result = $mysqli->query("SELECT nickname FROM users WHERE netID = \"{$_SERVER["REMOTE_USER"]}\";");
if (!$result) die(db_error($mysqli,"Query to check existence of person in table failed"));

if(!$row = $result->fetch_assoc()) {
    $userExists = false;
    $userVars["nickname"] = $_SERVER["REMOTE_USER"];
} else {
    $userExists = true;
    $userVars["nickname"] = $row["nickname"];
}

if(isset($_POST["nick"]) AND !empty($_POST["nick"])) {	
   if(!$userExists) {
        $result = $mysqli->query("SELECT netID FROM users WHERE nickname = \"{$_POST["nick"]}\";");
        if (!$result) die(db_error($mysqli,"Query to check existence of nickname in table failed"));
        
        if(!$row = $result->fetch_assoc()) {
            		
    		$query = "INSERT users (`netID`,`nickname`) 
                VALUES(
        			\"{$_SERVER["REMOTE_USER"]}\",
        			\"{$_POST["nick"]}\");";
    		
    		if(!$mysqli->query($query)) 
    			db_error($mysqli,"Query Error");
            else {
                $message = "success";
                $userExists = true;
            }
            
        } else $message = "nick";
    } else $message = "netid";
}

?>