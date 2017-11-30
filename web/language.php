<?php
/*
*	Constantes de mensagens
*/
	
// ERRO DE SQL
DEFINE("MYSQL_ERROR_CONNECT","N&#227;o foi poss&#237;vel estabelecer uma conex&#227;o com o Banco de Dados.");
DEFINE("MYSQL_ERROR_EXECUTE","Erro ao tentar executar instru&#231;&#227;o no servidor.");
DEFINE("MYSQL_ERROR_RESULT","N&#227;o foi encontrado nenhum resultado.");
DEFINE("MYSQL_ERROR_FETCH","N&#227;o foi poss&#237;vel percorrer o resultado.");
DEFINE("MYSQL_ERROR_CLOSE_CONNECT","Erro interno.");

// Mensagens Ajax.class
DEFINE("LOGIN_ERROR_AUTHENTIC","Email ou senha incorretos.");
DEFINE("FILL_FIELD","Preencha todos os campos.");
DEFINE("LOGIN_SUCCESS", "Logado com sucesso.");
DEFINE("EMAIL_EM_USO","E-mail em uso.");
DEFINE("CONFIRM_SENHA_INVALIDA","Confirma&#231;&#227;o de senha inv&#225;lida.");
DEFINE("CADASTRO_SUCESSO","Cadastro efetuado com sucesso.");
DEFINE("ERRO_CADASTRO","Cadastro n&#227;o efetuado.");
DEFINE("SUCESSO_CRIACAO_EQUIPE","Equipe criada com sucesso.");
DEFINE("ERRO_CRIACAO_EQUIPE","Erro ao tentar criar equipe.");
DEFINE("PERTENCE_EQUIPE","Voc&#234; j&#225; pertence a uma equipe.");
DEFINE("EMAIL_INVALIDO","Insira um e-mail v&#225;lido.");

// Mensagens Painel.class
DEFINE("SUCESSO_REMOVER_INTEGRANTE", "Integrante removido com sucesso.");
DEFINE("ERRO_REMOVER_INTEGRANTE", "Erro ao tentar remover integrante.");
DEFINE("USUARIO_INVALIDO","Usu&#225;rio inv&#225;lido.");
DEFINE("SUCESSO_ADICIONAR_USUARIO","Usu&#225;rio adicionado com sucesso.");
DEFINE("ERRO_ADICIONAR_USUARIO","Erro ao tentar adicionar usu&#225;rio.");
DEFINE("NOME_EM_USO","Nome de equipe em uso.");
DEFINE("MAXIMO_INTEGRANTES","A equipe pode conter no m&#225;ximo 4 integrantes.");
DEFINE("EQUIPE_EDITADA","Equipe editada com sucesso.");
DEFINE("ERRO_EQUIPE_EDITADA","Erro ao tentar editar equipe.");
DEFINE("NENHUMA_ALTERACAO","Nenhuma alteração foi feita.");

// Mensagens Capa.class
DEFINE("ANO_INVALIDO","Ano recebeu um valor inv&#225;lido.");
DEFINE("SUCESSO_CAPA","Capa salva com sucesso.");

// Mensagem Referencial.class
DEFINE("SUCESSO_REFERENCIAL_TEORICO","Referencial te&#243;rico salvo com sucesso.");
DEFINE("NENENHUM_REFERENCIAL","N&#227;o foi encontrado nenhum referencial te&#243;rico salvo.");
DEFINE("SUCESSO_REMOVE","Referencial teorico removido com sucesso.");
DEFINE("ERRO_REMOVE","Erro ao tentar remover.");

// Mensagem Introducao.class
DEFINE("SUCESSO_INTRODUCAO","Introdu&#231;&#227;o salva com sucesso.");

// Mensagem Metodologia.class
DEFINE("SUCESSO_TOPICO","Tópico adicionado com sucesso.");
DEFINE("ERRO_TOPICO","Erro ao tentar criar novo tópico.");
DEFINE("NOME_ITEM_VAZIO","Nome do item não pode estar vazio.");
DEFINE("ERRO_TAMANHO_TOPICO", "O nome do tópico deve conter no máximo 45 letras.");
DEFINE("METODOLOGIA_ITEMS_COMPLETO","É possível adicionar no máximo 5 itens.");
DEFINE("SUCESSO_ALTERACAO","Alterações feita com sucesso.");
DEFINE("IMAGE_DIMENSION","As dimensões da imagem devem ser no máximo 636x636.");
DEFINE("DONT_IMAGE","O arquivo não é uma imagem.");
DEFINE("IMAGE_FORMAT","A imagem deve ser nos formatos JPG, JPEG ou PNG.");
DEFINE("TOPICO_EXCLUIDO", "Tópico excluído com sucesso.");

// Mensagem Resumo.class
DEFINE("SUCESSO_RESUMO","Resumo salvo com sucesso.");

// Mensagem Conclusao.class
DEFINE("SUCESSO_CONCLUSAO", "Conclus&#227;o salva com sucesso.");

// Mensagem Materiais.class
DEFINE("SUCESSO_MATERIAIS","Materiais salvos com sucesso.");
DEFINE("MAX_MATERIAIS","Sua equipe j&#225; possui 10 materiais salvos, remova alguns para inserir novos materiais.");
DEFINE("SUCESSO_REMOVER","Material removido com sucesso.");
DEFINE("ERRO_REMOVER","Erro ao tentar remover o material.");

// Profile.class
DEFINE("SUCESSO_EDIT_PROFILE","Informa&#231;&#227;o editada com sucesso.");
DEFINE("INFORMACAO_VAZIA_PROFILE","Informa&#231;&#227;o vazia.");
DEFINE("ERRO_EDITAR_PROFILE","Erro ao tentar editar perfil.");

//Documento.class
DEFINE("DOCUMENTO_EXCLUIDO","Documento exclu&#237;do com sucesso.");
DEFINE("DOCUMENTO_ERRO_EXCLUIR","Erro ao tentar excluir documento.");
?>