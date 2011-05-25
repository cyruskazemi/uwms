<!DOCTYPE html>

<html>
	<link href="organizer.css" rel="stylesheet" type="text/css">
	<head><title>UW Servers</title></head>
	<body>
		<div id="heading" style="border: solid black 1px; text-align:center;">
			<h2>Header</h2>
		</div>
		<div id="content">
			<?php
				include_once('common/common.php');
				$serverID = $_GET['serverID'];
				$result = $mysqli->query("
					SELECT * 
					FROM servers s
					JOIN users u
					ON u.netID = s.creatorID
					WHERE serverID = " . $serverID
				);
				if (!$result) {
					die("Query Failed");
				}

				// Returns The amount of times favorited
				$popularityResult = $mysqli->query("
					SELECT s.serverName as Name, s.serverID as ID, count(f.serverID) as Popularity
					FROM servers s
					LEFT JOIN favorites f
					ON s.serverID = f.serverID 
					WHERE s.serverID = " . $serverID . "
					GROUP BY s.serverID
				");
				
				
				if (!$popularityResult) {
					die("Query Failed");
				}

				
				$data = $result->fetch_assoc();
				
				if(!$data['serverID']){
					echo "<h1>Server " . $serverID . " Not Found</h1>";
				} else {
					
					$popularityData = $popularityResult->fetch_assoc();

					$serverName = $data['serverName'];
					$nickname = $data['nickname'];
					$game = $data['game'];
					$IP = $data['serverIP'];
					$serverPort = $data['serverPort'];
					$serverPass = $data['serverPass'];
					$image = $data['image'];
					$popularity = $popularityData['Popularity'];
					$maxPlayers = $data['maxPlayers'];
					$whenCreated = $data['whenCreated'];
					$description = $data['description'];
					
					echo "<h1>" . $serverName . "</h1>";
					if($image){
						echo "<img src='" . $image . "' alt='" . $serverName . "' style=' width: 500px;'></img>";
					} else {
						echo"[No image has been added yet]";
					}
					echo "<h2> Created by " . $nickname . " On: " . $whenCreated . "</h2>";
					if($popularity == 0){
						echo "<h2> No one has favorited this server.</h2>";
					} else {
						echo "<h2> Favorited by " . $popularity . " users.</h2>";
					}
					echo "<h2>" . $game . "</h2>";
					echo "<h2>IP: " . $IP . "</h2>";
					if($serverPort){
						echo "<h2>Port: " . $serverPort . "</h2>";
					}
					if($serverPass){
						echo "<h2>Password: " . $serverPass . "</h2>";
					}
					echo "<h2>Maximum Playercount is " . $maxPlayers . ".</h2>";
					echo "<h2>Server Description</h2>";
					echo "<p>" . $description . "</p>";
					
				}
			?>
		</div>
	</body>
</html>