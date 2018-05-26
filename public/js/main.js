$().ready(function() {

	// validate register form on keyup and submit

	$.validator.setDefaults({ ignore: ":hidden:not(select)" });

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
		},
		errorPlacement: function(error, element) {
	        if (element.hasClass('chosen-select')) {
	            error.insertAfter(element.next('.chosen-container'));
	        }else{
	            error.insertAfter(element);
	        }
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
						$('#city').closest('.form-group').remove();
						$('#territory').closest('.form-group').remove();
					}else{
						$('#territory').closest('.form-group').remove();
					}
					$('#registerForm .fields-group').append(result);
			    }
			});
		}
	});

	// Chosen init
	$('.chosen-select').chosen({ width: '100%', height: '40px' });

});