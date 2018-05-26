<html>
	<head>
		<link rel="stylesheet" href="./public/css/bootstrap.min.css">
		<script src="./public/js/jquery-3.2.1.min.js"></script>
		<script src="./public/js/jquery.validate.min.js"></script>
	</head>
    <body>
    	<div class="col-6 mx-auto mt-5">
	        <h1 class="text-center">Вітаю, <?php echo $data['dasboard_info']['name']; ?>!</h1>
	        <div class="row">
	        	<h2 class="col-12 text-center">
	        		<?php echo $data['message']; ?>
	        	</h2>
	        </div>
	        <div class="row">
	        	<div class="col-4">
	        		Email:
	        	</div>
	        	<div class="col-8">
	        		Адреса:
	        	</div>
	        	<div class="col-4">
	        		<?php echo $data['dasboard_info']['email']; ?>
	        	</div>
	        	<div class="col-8">
	        		<?php echo $data['dasboard_info']['ter_address']; ?>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-12">
	        		<a href="/">Повернутися до реєстрації</a>
	        	</div>
	        </div>
	    </div>
    </body>
</html>