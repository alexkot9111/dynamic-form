<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./public/css/bootstrap.min.css">
		<link rel="stylesheet" href="./public/css/chosen.min.css">
		<script src="./public/js/jquery-3.2.1.min.js"></script>
		<script src="./public/js/jquery.validate.min.js"></script>
		<script src="./public/js/chosen.jquery.min.js"></script>
	</head>
    <body>
    	<div class="form-container col-4 mx-auto mt-5">
	        <h1 class="text-center">Форма реєстрації</h1>
	        <form id="registerForm" action="" method="POST">
	        	<div class="fields-group">
		        	<div class="form-group">
		        		<input type="text" class="form-control" name="name" id="name" value="" placeholder="Введіть ПІБ" />
		        	</div>
		            <div class="form-group">
					    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Введіть email">
					</div>
					<div class="form-group">
					    <select class="form-control dynamic-select chosen-select" id="region" name="region" title="Будь ласка, оберіть область" data-ter_type="1" data-ter_level="2" required>
					    	<option value="" selected disabled>Оберіть область...</option>
					    	<?php 
					    		foreach ($data as $region) {
					    			echo '<option value="'.$region['ter_id'].'">'.$region['ter_name'].'</option>';
					    		}
					    	?>
					    </select>
					</div>
				</div>
	            <button type="submit" class="btn btn-primary btn-block">ВІДПРАВИТИ</button>
	        </form>
        </div>
        <script src="./public/js/main.js"></script>
    </body>
</html>