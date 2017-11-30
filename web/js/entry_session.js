$(function() {
	$('#email').focus();
	$('#name').focus();
	$('#form-login, #form-register').on('submit',function(e) {
		e.preventDefault();
		e.stopPropagation();

		var url = $(this).attr('id') == 'form-login' ? 'login' : 'register';

		var form = new FormData(this);

		$.ajax({
			url: '?ajax='+url,
			type: 'POST',
			dataType: 'json',
			data: form,
			processData: false,
			contentType: false,
			cache: false,
		})
		.done(function(data)
		{
			var obj;

			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').html(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		})
		.fail(function(data)
		{
			alert('Error');
		});
		
	})
});