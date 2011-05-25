<?php
	$_ERRORS = array();

	// Function to connect to MySQL
	$mysqli = @new mysqli('vergil.u.washington.edu','root','100degrees','uw_servers',42731); 
	if(mysqli_connect_error())
		die(db_error($mysqli));
		
		
	// MySQL error handler 
	function db_error($mysqli, $custom_message = "") {
		global $_ERRORS;
		$custom_message .= ($custom_message?": ":"");
		if(@$mysqli->error)
			$errormsg = "{$mysqli->error} ({$mysqli->errno})";
		else
			$errormsg = mysqli_connect_error();
		$errormsg = $custom_message . $errormsg;
		$_ERRORS[] = $errormsg;
		return $errormsg;
	}
	
	// Input Sanitizer
	function sanitizeInput($input, $db) {
		if(is_array($input)) {
			$output = array();
			foreach($input as $key => $value) {
				$output[$key] = sanitizeInput($value, $db);
			}
			return $output;
		} else {
			$output =  strip_tags($input);
			$output =  htmlentities($output);
			$output =  $db->real_escape_string($output);
			
			return $output;
		}
	}
		
	// Function to post the date in a MySQL-approved format
	function mysql_date($timestamp = "", $notime = false) {
		if(!$timestamp) $timestamp = time();
		if($notime) return date("Y-m-d H:i:s",$timestamp);
		else return date("Y-m-d",$timestamp);
	}

	// Function to add or modify a get var to a URL.
	function appendGetVar($variable, $value, $escape = true, $url = "") {
		if(!$url) $url = $_SERVER['REQUEST_URI'];
		$newURL = preg_replace("/([&\?])$variable=[a-zA-Z0-9_\-,]*/", "$1$variable=$value", $url);
		if(strpos($url,"?") === false) $delim = "?";
		else $delim = "&";
		if(!preg_match("/$variable=$value/",$newURL) && $url == $newURL) $newURL = $url . "$delim$variable=$value";
		if($escape) $newURL = str_replace("&", "&amp;", $newURL);
		
		return $newURL;
	}

	session_start();
	require("class.template.php");
?>