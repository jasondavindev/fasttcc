$(function()
{
	$('.edit_informacao').on('submit',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=edit_info',
			type: 'POST',
			dataType: 'json',
			data: form,
			processData: false,
			cache: false,
			contentType: false,
		})
		.done(function(data) {
			var obj;

			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').html(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		})
		.fail(function() {
			alert('Ocorreu um erro inesperado.');
		});
		
	});

	$('.close-modal').on('click',function()
	{
		$('.box, .modal').fadeOut('fast');
	});

	$('#edit_nome').on('click',function()
	{
		$('.modal, #box-name').fadeIn('fast');
	});

	$('#view_email').on('click',function()
	{
		$('.modal, #box-email').fadeIn('fast');
	});

	$('#edit_senha').on('click',function()
	{
		$('.modal, #box-senha').fadeIn('fast');
	});
});