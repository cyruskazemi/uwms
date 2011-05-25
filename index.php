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
			
            $("#mainForm").validationEngine(); 
			
		});
		
	</script>
</head>
<body>

	<?php $template->printTop($userVars); 
        if(isset($message)) 
            if($message == "success") 
        	   echo "<div class=\"notify success\">Thanks, your nickname has been set.</div><br />"; 
       	if(!$userExists) {
    ?>
    
        
		<section id="notification">		
			<h1>Welcome!</h1>
			<p>Since this is the first time you are using this website, you may select a nickname to use throughout the website.</p>
			<p>If you do not select a nickname, your UW NetID will be used.</p>
			<form id="mainForm" action="index.php" method="post">
				<fieldset>						
                    <?php 
                        if(isset($message))
                            if($message == "nick") 
                        	   echo "<div class=\"notify error\">The nickname you selected is taken.</div>"; 
                            elseif($message == "netid") 
                        	   echo "<div class=\"notify error\">Your netID already has a nickname!</div>"; 
                        $template->printErrors($_ERRORS);
                    ?>
					<p>
						<label for="f1.nick">Desired Nickname</label><br />
							<input type="text" id="f1.nick" name="nick" class="validate[custom[onlyLetterNumber]]"
                            <?php if(isset($_POST["nick"])) echo "value=\"" . $_POST["nick"] . "\" "; ?> />
							<input type="submit" class="search" value="Submit" />
					</p>
				</fieldset>
			</form>
		</section>
        
    <?php } ?>
	
	<section class="content left">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare libero eget sem facilisis ullamcorper laoreet velit semper. Donec leo orci, pellentesque ultrices pharetra in, dictum at ipsum. Quisque sollicitudin arcu ac turpis pretium sit amet adipiscing odio tempus. Mauris elementum tellus non lorem hendrerit quis scelerisque nibh pharetra. Vestibulum ornare, purus non gravida volutpat, metus magna cursus risus, tincidunt sodales magna arcu iaculis leo. Aenean nec purus tortor. Ut tempus enim non mi pellentesque facilisis. Duis vitae odio eget erat ullamcorper lacinia sagittis ut justo. Curabitur quis enim diam. Suspendisse potenti. Proin sollicitudin mollis rhoncus. Vestibulum tincidunt arcu sit amet arcu sagittis non varius magna eleifend.</p>
	</section>
    <section id="sidebar">
	<h1>Top 5 Servers</h1>
	</section>
        <?php $template->printClear(); ?>
    
	<?php $template->printBottom(); ?>
	</div>
</body>
</html>