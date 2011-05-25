<?php
	include_once("common/common.php");
	$template = new Template("Index");
    include_once("new_user.php")
?>
<!DOCTYPE html>
<html>
<head>
	<?php $template->printHeader(); ?>

	<script>
	
		$(function(){
			
            $("#serverEntry").validationEngine(); 
			
		});
		
	</script>
</head>
<body>

	<?php 
        $template->printTop($userVars); 
    ?>
	
	<section class="content">
	
        <form class="complex" enctype="multipart/form-data" id="serverEntry" action="serverEntry.php" method="POST">
			<fieldset style="background-color: #222;">
				<legend>Server Form</legend>
				<p>
					<label for="f1.game">Game</label><br />
        				<select name="game" id="f1.game">
        					<option value="0">- please select -</option>
        					<option value="mine">Minecraft	</option>
        					<option value="css">Counterstrike Source</option>
        					<option value="cs16">Counterstrike 1.6</option>
        					<option value="l4d">Left 4 Dead 1/2</option>
        					<option value="tf2">Team Fortress 2</option>
        				</select>
				</p>
				<p>
					<label for="f1.name">Server Name</label><br />
						<input type="text" id="f1.name" name="serverName" class="validate[required]" />
				</p>
				<p>
					<label for="f1.pass">Server Password</label><br />
						<input type="text" id="f1.pass" name="serverPass" />
				        <small>eg. passw0rd</small>	
				</p>
				<p>
					<label for="f1.ip">Server IP Address</label><br />
						<input type="text" id="f1.ip" name="serverIP" class="validate[custom[ipv4]]" />
				        <small>eg. 123.456.789.10</small>
				</p>
				<p>
					<label for="f1.port">Server Port</label><br />
						<input type="text" id="f1.port" name="serverPort" class="validate[custom[onlyNumbers]]" />
				        <small>eg. 12345</small>
				</p>
				<p>
					<label for="f1.image">Banner Image</label><br />
        				<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        				<input type="file" name="image" id="f1.image"/> 
				</p>
				<p>
					<label for="f1.maxplayers">Max Players</label><br />
						<input type="text" id="f1.maxplayers" name="maxPlayers" />
				</p>
				<p>
					<label for="f1.desc">Description</label><br />
						<input type="text" id="f1.desc" name="description" />
				</p>
				
				
				
				<input type="submit" name="submit" class="submit" value="SUBMIT DAT FORM"/> 
			</fieldset>
			
		</form>
	
	</section>
	
	<?php 
        $template->printBottom(); 
	?>

</body>
</html>


