<?php
class Template {
	public $title, $scheme, $url;
	
	public function __construct($new_title = "Untitled Document", $urlappend = "") {
		$this->title = $new_title;
		$this->url = $urlappend;
	}
	
	// Print the header, including doctype tags and open html tag.
	public function printHeader() {
		echo "<meta charset=utf-8 />
		<title>{$this->title} | UW Multiplayer Servers</title>
		<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"css/main.css\" />
		<link rel=\"stylesheet\" href=\"css/validationEngine.jquery.css\" type=\"text/css\"/>
		<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js\"></script>
		<script src=\"js/jquery.validationEngine-en.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
		<script src=\"js/jquery.validationEngine.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
		<!--[if IE]>
		<script type=\"text/javascript\" src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>
		<script type=\"text/javascript\" src=\"http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js\"></script>
		<![endif]-->
		";
	}
	
	//Print the standard page top down to the content box, leaving an open tab.
	public function printTop($userVars, $curr_loc = "0") {
	
		echo "
		<nav id=\"topbar\"><div id=\"outer\"><div>Welcome <a href=\"\">{$userVars["nickname"]}</a>!</div></div></nav>
		<div id=\"container\">
		<header id=\"uwms\">
			<img src=\"images/header.png\" alt=\"UW Multiplayer Server\" />
		</header>
		<div id=\"nav\">
			<ul><a href=\"\"><li>Games</li></a>
			<a href=\"\"><li>Servers</li></a>
			<a href=\"\"><li>Users</li></a></ul>
		</div>
		<div id=\"contentContainer\">";
	}

	// Prints the standard page bottom.
	public function printBottom() {
		echo "
		</div>";
	}
	
	// Prints the standard page bottom.
	public function printClear() {
		echo "<div class=\"clr\"></div>";
	}

	// Prints the standard page bottom.
	public function printErrors($error_arr) {
		if(count($error_arr) > 0) {
			echo "<div class=\"notify error\">";
			foreach($error_arr as $error_msg) 
				echo "$error_msg<br />\n";
			echo "</div>";
		}
	}
}
?>