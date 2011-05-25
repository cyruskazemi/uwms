<?php
	include_once("common/common.php");
	
	$template = new Template("Index");
?>
<!DOCTYPE html>
<html>
<head>
	<?php $template->printHeader(); ?>

	<script>
	
		$(function(){
			
			
			
		});
		
	</script>
</head>
<body>

	<?php $template->printTop(); ?>
	
		<section class="content">
		
		blah
		
		</section>
		
	<?php $template->printBottom(); 
	
		var_dump($_SERVER);
	?>

</body>
</html>