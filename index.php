<?php
	header('Access-Control-Allow-Origin: *');
?>
<html>
	<head>
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
		<link rel="stylesheet" href="style.css">

		<title>Instagram Data</title>

	</head>
	<body>
		<div class="col-md-12">
			<form id="dataToScrape" class="col-md-6 offset-md-3" action="index.php" method="post">
				<div id="inputContainer" class="col-md-12">
					<div class="col-md-12 input-component" style="">
						<div class="col-md-11" >
							<input type="text" name="this[]" class="sourceData text-input" placeholder="Instagram link..." required>
						</div>
						<div class="col-md-1">
							<span class="deleteInput delete-input-component glyphicon glyphicon-remove" aria-hidden="true"></span>
						</div>
					</div>
					<div class="col-md-12 input-component" style="">
						<div class="col-md-11" >
							<input type="text" name="this[]" class="sourceData text-input" placeholder="Instagram link..." required>
						</div>
						<div class="col-md-1">
							<span class="deleteInput delete-input-component glyphicon glyphicon-remove" aria-hidden="true"></span>
						</div>
					</div>
					<div class="col-md-12 input-component" style="">
						<div class="col-md-11" >
							<input type="text" name="this[]" class="sourceData text-input" placeholder="Instagram link..." required>
						</div>
						<div class="col-md-1">
							<span class="deleteInput delete-input-component glyphicon glyphicon-remove" aria-hidden="true"></span>
						</div>
					</div>
					<div class="col-md-12 input-component" style="">
						<div class="col-md-11" >
							<input type="text" name="this[]" class="sourceData text-input" placeholder="Instagram link..." required>
						</div>
						<div class="col-md-1">
							<span class="deleteInput delete-input-component glyphicon glyphicon-remove" aria-hidden="true"></span>
						</div>
					</div>
				</div>
				<div class="col-md-12" style="display: inline-flex;margin: 20px 0px;">
					<div class="col-md-3" >
						<div id="addMoreButton" class="button-outline">
							Add Links
						</div>
						<span style="display:none;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</div>
					<div class="col-md-3" >
						<div id="clearFields" class="button-outline hideOnLoad">
							Clear Fields
						</div>
						<span style="display:none;" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</div>
					<div class="col-md-3">
						<div id="submitButton" class="button-outline success-button">
							Submit
						</div>
						<div id="postSubmitLoader" class="hideOnLoad loader-text">Loading...</div>
						<a id="downloadLink" class="hideOnLoad" href="" download>
							<div id="addMoreButton" class="button-outline blue-button">
								Download
							</div>
						</a>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-12 offset-md-2">
			<!-- <a id="downloadLink" class="hideOnLoad" href="" download>
			  Download File
			</a> -->
			<textarea id="jsonOutput" style="display:none;" rows="4" cols="200">
				
			</textarea> 
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript" src="config.js"></script>
		<script type="text/javascript" src="javascripts.js"></script>
	</body>

</html>