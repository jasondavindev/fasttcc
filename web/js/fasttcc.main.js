$(function()
{
	/*
	* Funcionalidades NavBar
	*/
	$(document).on('click','#button-bar',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		$('#dropdown').animate({width: 'toggle'}, 300);
	});

	/*
	* Funcionalidades adicionar usuarios
	*/

	if($('#box-integrantes').length > 0)
	{
		$.get('?act=integrantes', function(data)
		{
			var obj;

			if(obj = $.parseJSON(data))
			{
				var str = '';

				for(var i in obj)
				{
					str += '<div class="integrante">'+
					'<div class="infos">'+
					'<div class="nome">'+obj[i].nome+'</div>'+
					'<div class="email">'+obj[i].email+'</div>'+
					'</div>';

					if(obj[i].tipouser !== 1)
					{
						str += '<div class="acao"><button id="'+obj[i].id+'" class="material-icons act-remove">close</button></div>';
					}

					str += '</div>';
				}
			}

			$('#box-integrantes').html(str);
		});


		$(document).on('click','#box-integrantes .act-remove',function()
		{
			var id = $(this).attr('id');

			$.get('?act=remover&id='+id,function(data) {
				var obj;

				if(obj = $.parseJSON(data))
				{
					$('#snack-message').hide();
					$('#snack-message').show();
					$('#message').html(obj.status);
					setTimeout(function() { $('#snack-message').hide(); },3000);
				}
			});
		});
	}

	if($('#box-usuarios').length > 0)
	{
		var array_usuarios = [];

		$.get('?act=usuarios', function(data)
		{
			var obj;

			if(obj = $.parseJSON(data))
			{
				var str = '';

				for(var i in obj)
				{
					array_usuarios = obj;

					str += '<div class="integrante">'+
					'<div class="infos">'+
					'<div class="nome">'+obj[i].nome+'</div>'+
					'<div class="email">'+obj[i].email+'</div>'+
					'</div>';

					if(obj[i].tipouser !== 1)
					{
						str += '<div class="acao"><button id="'+obj[i].id+'" class="material-icons act-remove">add</button></div>';
					}

					str += '</div>';
				}
			}

			$('#box-usuarios').html(str);
		});

		var setTimeOutSearch;

		$(document).on('keyup','#input-search',function()
		{
			clearInterval(setTimeOutSearch);

			setTimeOutSearch = setTimeout(function()
			{
				var pesquisa = $('#input-search').val();
				var str = '';

				for(var i in array_usuarios)
				{
					if(array_usuarios[i].nome.search(pesquisa) >= 0 || array_usuarios[i].email.search(pesquisa) >= 0)
					{
						str += '<div class="integrante">'+
							'<div class="infos">'+
							'<div class="nome">'+array_usuarios[i].nome+'</div>'+
							'<div class="email">'+array_usuarios[i].email+'</div>'+
							'</div>'+
							'<div class="acao"><button id="'+array_usuarios[i].id+'" class="material-icons act-remove">add</button></div>'+
						'</div>';
					}
				}

				$('#box-usuarios').html(str);

				if(str==='')
				{
					$('#box-usuarios').html('<p style="padding: 0 5px;">Nenhum usuário encontrado.</p>');
				}

			}, 500);
		});
	}

	$(document).on('click','#box-usuarios .act-remove',function()
	{
		var id = $(this).attr('id');

		$.get('?act=adicionar&id='+id,function(data) {
			var obj;

			if(obj = $.parseJSON(data))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').html(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		});
	});

	/*
	* Funcionalidades Criar equipe
	*/
	$(document).on('submit', '#frm-criar-equipe', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=cadastrar',
			type: 'POST',
			dataType: 'json',
			data: form,
			processData: false,
			cache: false,
			contentType: false,
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
		});
		
	});



	/*
	* Funcionalidades adicionar campos objetivos especificos
	*/

	var btn_add = $('#add_obj'),
	div_objs = $('#objetivos_esp');

	$('#panel-obj-esp .input_text').keyup(function(e) {
		if(e.keyCode === 13) {
			$(btn_add).click();
		}
	});

	btn_add.on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var length = $('#objetivos_esp input[type="text"]').length;

		if(length<10)
		{
			var campo = $('<input></input>').attr({
				type: 'text',
				name: 'objetivo['+(length+1)+']',
				class: 'input_text',
				valie: ''
			});
			div_objs.append(campo);
			$(campo).focus();
		}
		else
		{
			$('#snack-message').hide();
			$('#snack-message').show();
			$('#message').text('É permitido no máximo 10 objetivos específicos.');
			setTimeout(function() { $('#snack-message').hide(); },3000);
		}
	});


	/*
	* Funcionalidades Tab
	*/
	$(document).on('click','.tab a', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		$('.tablink').removeClass('active');
		$('.tabcontent').css('display','none');
		$(this).addClass('active');
		$('#tab_'+$(this).attr('id')).css('display','block');
	});
	
	if($('.tablink').length > 0)
	{
		$('.tablink')[0].click();
	}


	/*
	* Funcionalidades Menu accordion
	*/

	$('.menu-accordion a.accordion').on('click', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		$(this).toggleClass('active');
		var next = $(this).next();
		$(next).slideToggle(150);
	});


	/*
	* Funcionalidades Conclusao
	*/

	$('#frm-conclusao').on('submit',function(e)
	{
		e.stopPropagation();
		e.preventDefault();

		var form = new FormData(this);

		$.ajax({
			url: '?act=go',
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
			var json = JSON.stringify(data);

			if(obj = $.parseJSON(json))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').text(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		})
		.fail(function() {
			alert('Error');
		});
	});


	/*
	* Funcionalidades Metodologia
	*/

	// Funcao criar novo topico
	
	$('#view-modal-novo-item').click(function()
	{
		$('#modal-novo-item').fadeIn('fast');
		$('#nome-item').focus().val('');
	});

	$('#submit-topico').click(function(e){
		e.preventDefault();
		e.stopPropagation();

		$.ajax({
			url: '?act=add',
			type: 'POST',
			dataType: 'json',
			data: {nome_item: $('#nome-item').val(), item_pai: $('#item_pai').val()},
		})
		.done(function(data)
		{
			var json = parse(data);

			var tempo = (json.error === true) ? 5000 : 1500;

			sucesso(json.mensagem, function() {
				if(json.error != true)	location.reload();
				$('.pop-message').removeClass('show');
			}, tempo);
		})
		.fail(function() {
			erro('Erro inesperado.');
		});
	});

	$('.cancel-topico').click(function(e) {
		e.preventDefault();
		e.stopPropagation();

		$('.modal').fadeOut('fast');
	});

	// Fim funcao criar novo topico


	// funcao submit salvar topico
	$('#frm-metodologia').submit(function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=save_content',
			type: 'POST',
			dataType: 'json',
			data: form,
			processData: false,
			cache: false,
			contentType: false,
		})
		.done(function(data)
		{
			if(obj = parse(data))
			{
				$('#snack-message').hide().show();
				$('#message').html(obj.mensagem);
				setTimeout(function() { $('#snack-message').hide(); },3000);

				sucesso(obj.mensagem,function() {
					$('.pop-message').removeClass('show');
				}, 5000);
			}
		})
		.fail(function() {
			erro('Ocorreu um erro inesperado.');
		});
	});
	// fim funcao submit salvar topico

	// funcao carregar topico
	$('a[data-id]').on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var id = $(this).attr('data-id');

		$.ajax({
			url: '?act=load_item',
			type: 'POST',
			dataType: 'json',
			data: {id_item: id},
		})
		.done(function(data)
		{
			if(obj = parse(data))
			{
				$('#id_item').val(obj.id_item);
				$('#nome_topico').val(obj.nome_item);
				$('#txt_texto').val(obj.txt_texto);
				$('#nome_img_texto').val(obj.nome_img_texto);
				$('#fonte_img_texto').val(obj.fonte_img_texto);
				$('#txt_resultado').val(obj.txt_resultado);
				$('#nome_img_resultado').val(obj.nome_img_resultado);
				$('#fonte_img_resultado').val(obj.fonte_img_resultado);
				if(obj.img_texto!==null) {
					$('img[data-image="texto"]').attr('src','uploads/images/'+obj.img_texto);
				}
				if(obj.img_resultado!==null) {
					$('img[data-image="resultado"]').attr('src','uploads/images/'+obj.img_resultado);
				}
				$('#edit-item-metodologia').show();
				var scrolltop = $('#edit-item-metodologia').position().top;
				$('html,body').animate({ scrollTop: scrolltop}, 600);
			}
		})
		.fail(function() {
			alert("Error");
		});
	});
	// fim funcao carregar topico


	// funcao excluir topico
	$('#excluir-item').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		$('#modal-remove-item').fadeIn('fast');
	});
	$('#remove-topico').click(function(e){
		e.preventDefault();
		e.stopPropagation();

		var id = $('#id_item').val();

		$.ajax({
			url: '?act=remove',
			type: 'POST',
			dataType: 'json',
			data: {id_item: id},
		})
		.done(function(data) {
			if(obj = parse(data))
			{
				sucesso(obj.mensagem,function() {
					if(obj.error != true)	location.reload();
					$('.pop-message').removeClass('show');
				}, 1500);
			}
		})
		.fail(function() {
			erro('Erro inesperado.');
		});
		
	});
	// fim funcao excluir topico


	$('#modal-img-item #close-modal').on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		$('#modal-img-item').fadeOut();
	});

	$('#frm-metodologia #view-image').on('click',function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		$('#content-box img').hide();
		$('img[data-image="'+$(this).attr('data-image')+'"]').show();
		$('#modal-img-item').fadeIn();
	});

	$('#div-checkbox label').on('click',function()
	{
		var obj = '#fonte_img_'+$(this).attr('data-type');

		if($(this).text() == 'check_box_outline_blank')
		{
			$(this).text('check_box');
			$(obj).val('Autoria própria');
			$(obj).prop('readonly',true);
			$(obj).attr('font-type','0');
		}
		else if($(this).text() == 'check_box')
		{
			$(this).text('check_box_outline_blank');
			$(obj).val('');
			$(obj).prop('readonly',false);
			$(obj).attr('font-type','1');
		}
	});

	/*
	* Funcionalidades Materiais
	*/
	$('#view-materiais').on('click',function()
	{
		$.ajax({
			url: '?act=load',
			type: 'POST',
			dataType: 'json',
		})
		.done(function(data)
		{
			var str = '';

			for(var i in data)
			{
				str += '<div class="item" id="item-'+i+'">'+
				'<span>'+data[i]+'</span>'+
				'<button class="material-icons button-flat-no-padding rmv-item">delete</button>'+
				'</div>';
			}

			if(str === '') str = 'Nenhum material foi salvo até o momento.';

			$('#content-materiais').html(str);
		});
	});

	/*
	* Remover item salvo
	*/
	$(document).on('click','#modal-materiais .item .rmv-item', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		$('.modal-dica').hide();

		var id = btoa($(this).parent('.item').attr('id').replace('item-',''));

		$.ajax({
			url: '?act=remove',
			type: 'POST',
			dataType: 'json',
			data: {id_item: id},
		})
		.done(function(data) {
			var obj;
			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').text(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		});
		
	});

	var items = 1;

	/*
	* Adicionar item
	*/
	$(document).on('click','#items-add .add-item',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if(items < 10)
		{
			$('<div class="item-materiais">'+
				'<input type="text" class="input_text" name="item_mat[]"/>'+
				'<div class="div-buttons">'+
				'<button class="button-flat-no-padding material-icons rmv-item">remove</button>'+
				'</div></div>').appendTo('#items-add');
			items++;
		}
		else {
			$('#snack-message').hide();
			$('#snack-message').show();
			$('#message').text('É possível adicionar no máximo 10 materiais.');
			setTimeout(function() { $('#snack-message').hide(); },3000);
		}
	});

	/*
	* Remover item
	*/
	$(document).on('click','#items-add .rmv-item',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if(items > 1)
		{
			$(this).parent().parent().remove();
			items--;
		}
	});

	$('#frm-materiais').on('submit',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=save',
			type: 'POST',
			dataType: 'json',
			data: form,
			cache: false,
			contentType: false,
			processData: false,
		})
		.done(function(data)
		{
			var obj;
			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').text(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		});
	});

	/*
	* Funcionalidades Referencial
	*/
	if($('#inputs-citacao-ref').length > 0)
	{
		var objs = $('#inputs-citacao-ref input');
		var name = '';
		for(var i = 0; i < objs.length; i++)
		{
			if($(objs[i]).prop('checked') == true)
			{
				name = $(objs[i]).attr('id').replace('citacao-','');
				$('#r_'+name).text('radio_button_checked');
				break;
			}
		}
	}

	$('#inputs-radio .radio-citacao').on('click',function()
	{
		$(this).text('radio_button_checked');

		var objs = $('#inputs-radio .radio-citacao');

		for(var i = 0; i < objs.length; i++)
		{
			if($(objs[i]).attr('id') !== $(this).attr('id'))
			{
				$(objs[i]).text('radio_button_unchecked');
			}
		}
	});

	$(document).on('click','#view-references,#view-materiais',function(e)
	{
		$('#content_referencias,#modal-materiais').fadeToggle('fast');
	});

	$(document).on('click','button.close-pop, button.remove',function(e)
	{
		$('.modal-dica').fadeOut('fast');
	});

	var id_remover = null;

	$(document).on('click', '.row_content button.remove', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var id = $(this).attr('id');
		id_remover = id;
		$('#remover-item').fadeIn('fast');
	});

	$(document).on('click', '#remover-item #deny', function(e)
	{
		e.preventDefault();
		e.stopPropagation();
		
		id_remover = null;
		$('#remover-item').css('display','none');
	});
	$(document).on('click', '#remover-item #accept', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		if(id_remover !== null)
		{
			window.location = '?act=remove&id='+id_remover;
			id_remover = null;
		}
		else
		{
			$('#remover-item').css('display','none');
		}
	});

	$('#frm-referencial').on('submit', function(e)
	{
		e.stopPropagation();
		e.preventDefault();

		var form = new FormData(this);

		$.ajax({
			url: '?act=go',
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
		.fail(function() {
			alert('Error');
		});
		
	});

	/*
	* Funcionalidades Capa Resumo Introducao
	*/
	$(document).on('submit','#frm-capa, #frm-resumo-port, #frm-resumo-ing, #frm-introducao, #frm-conclusao',function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=go',
			type: 'POST',
			dataType: 'json',
			data: form,
			processData: false,
			cache: false,
			contentType: false,
		})
		.done(function(data)
		{
			var obj;
			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#snack-message').hide();
				$('#snack-message').show();
				$('#message').text(obj.status);
				setTimeout(function() { $('#snack-message').hide(); },3000);
			}
		});
	});


	/*
	* Funcionalidades editar equipe
	*/
	$(document).on('submit', '#frm-edit-equip', function(e)
	{
		e.preventDefault();
		e.stopPropagation();

		var form = new FormData(this);

		$.ajax({
			url: '?act=edit_equip',
			type: 'POST',
			dataType: 'json',
			data: form,
			cache: false,
			processData: false,
			contentType: false,
		})
		.done(function(data)
		{
			var obj;
			if(obj = $.parseJSON(JSON.stringify(data)))
			{
				$('#mensagem').text(obj.status);
			}
		});
		
	});

	/*
	* Funcionalidades Pop up dica
	*/
	$('i.help').click(function() {
		var pop = $(this).attr('data-pop');

		$('div[data-dica="'+pop+'"]').fadeToggle('fast');
	});

	$('.modal-dica .close').on('click',function()
	{
		$('.modal-dica').fadeOut();
	});
	$(document).on('click',function(e)
	{
		var modal = document.getElementById('modal-dica');
		if(e.target==modal)
		{
			$('.modal-dica').fadeOut();
		}
	});

	/*
	* Funcionalidades Documento
	*/
	$('#more-itens-doc').on('click',function(e)
	{
		$('#dropdown-menu-document').fadeToggle('fast');
	});

	$('#delete-document').on('click',function(e) {
		e.preventDefault();
		e.stopPropagation();

		$.ajax({
			url: '?act=delete',
			type: 'POST',
			dataType: 'json',
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
		.fail(function() {
			alert('Error');
		});
		
	});

	Object.size = function(obj) {
	    var size = 0, key;
	    for (key in obj) {
	        if (obj.hasOwnProperty(key)) size++;
	    }
	    return size;
	};

	function parse(data)
	{
		return $.parseJSON(JSON.stringify(data));
	}

	/* Other Styles */
	$('.input_with_tip .input').focus(function() {
		$(this).parent().addClass('active');
	});
	$('.input_with_tip .input').blur(function() {
		$(this).parent().removeClass('active');
	});

	$('.textarea_tip .textarea').focus(function() {
		$(this).parent().addClass('active');
	});
	$('.textarea_tip .textarea').blur(function() {
		$(this).parent().removeClass('active');
	});

	$('#btn-example-fonte').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		$('.pop-dica').fadeOut();
		$('#exemplo_fonte_citacao').fadeIn();
	});

	$('#btn-view-example-referencia').click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		$('.pop-dica').fadeOut();
		$('#exemplo_referencia').fadeIn();
	});

	$(window).scroll(function() {
		$('#presentation').css('background-position', '50% '+($(this).scrollTop()/2)+'px');
	});

	function erro(msg) {
		$('.pop-message p').text(msg);
		$('.pop-message').addClass('show');
		$('.modal').fadeOut('fast');
		setTimeout(function() {$('.pop-message').removeClass('show')},5000);
	}

	function sucesso(msg,func,time) {
		$('.pop-message p').text(msg);
		$('.pop-message').addClass('show');
		$('.modal').fadeOut('fast');
		setTimeout(func,time);
	}
});