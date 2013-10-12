<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.pic { border: 3px solid #fff; height: 150px; width: 150px; display: inline-block; position: relative; }
		.pic span { 
			position: relative;
			bottom: 3px;
			z-index: 1; 
			font-family: Arial, sans-serif; 
			font-weight: bold; 
			color: #fff;
		}
		.overlay { height: 100%; width: 100%; position: absolute; top: 0; left: 0; z-index: 3; }
		.overlay.active { background: rgba(255,255,255,0.50); }

		.check { position: relative; top: 10px; left: 10px; height: 15px; width: 15px; background: #0f0; }
		.check.hide { display: none; }
	</style>
</head>
<body>
	<?php
		// Supply a user id and an access token
		$userid = "";
		$accessToken = "";

		// Gets our data
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}

		// Pulls and parses data.
		$result = fetchData("https://api.instagram.com/v1/tags/nerdapalooza/media/recent?access_token={$accessToken}");
		$result = json_decode($result);
	?>


	<?php foreach ($result->data as $post): ?>
		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
		<div class="pic" style="background: url('<?= $post->images->thumbnail->url ?>') 0 0 #fff;">
			<div class="overlay">
				<div class="check hide"></div>
			</div>

			<span><?= $post->user->username ?></span>
		</div>
	<?php endforeach ?>

	<script type='text/javascript' src='jquery.min.js'></script>
	<script>
		$(".pic").on("click", function() {
			var overlay = $(this).find('.overlay');
			var check = overlay.find('.check');

		 	if(overlay.hasClass('active')) {
		    	overlay.removeClass('active');
		    	check.addClass('hide');
		  	} else { 
		    	overlay.addClass('active');
		  		check.removeClass('hide');
		  	}
		});
	</script>
</body>
</html>