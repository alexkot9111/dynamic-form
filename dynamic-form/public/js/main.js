$().ready(function() {

	// validate register form on keyup and submit
	$("#registerForm").validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			region_select: {
				required: true,
			},
		},
		messages: {
			name: {
				required: "Будь ласка, введіть ім'я",
				minlength: "Ваше ім'я має містити мінімум 2 символи"
			},
			email: "Будь ласка, введіть коректний email",
		}
	});

	//ajax reg-return button
	$('body').on('change', '#registerForm .dynamic-select', function(){

		var ter_type =  $(this).attr('data-ter_type');
		var ter_level =  $(this).attr('data-ter_level');
		var ter_pid = $(this).val();
		var id = $(this).attr('id');

		if (parseInt(ter_type)) {
			$.ajax({
				type: 'POST',
				url: "index.php",
				data: {
					ter_pid: ter_pid,
					ter_type: ter_type,
					ter_level: ter_level
				},
				success: function(result){
					if (id == 'region') {
						$('#city').remove();
						$('#territory').remove();
					}else{
						$('#territory').remove();
					}
					$('#registerForm .fields-group').append(result);
			    }
			});
		}
	});

});