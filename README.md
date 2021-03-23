Objetivo do projeto: Desenvolver um sistema para agenda de Contatos, seguindo rotinas e funcionalidades propostas no teste;

Funcionalidades, atualmente pode-se cadastrar um novo contato, cadastrar e editar dados de endereço, cadastrar e editar dados de telefone e pesquisar um contato pelo nome.

Validações: Possui validações nas telas, na tela de cadastro de contato, deve-se inserir no mínimo 1 caractere no campo de nome, caso seja inserido algo no campo cpf, ele precisa ser diferente do que já se tem cadastradom, e irá ser validado pela quantidade de caracteres inseridos, além do cálculo que valida o número do cpf.

Campo de E-mail caso seja inserido deve possui "@" depois de algum caractere, "." em algum lugar após "@" e algo após o ".", além de que também precisa ser único. 

Telefone Celular, precisa conter 11 dígitos, também único salvo;

Na tela de endereço precisa apenas do contato selecionado, possui pesquisa de dados de endereço através do CEP, devendo-se apenas inserir o número.

Na tela de telefones, deve-se selecionar um contato, os telefones precisam conter 10 dígitos (telefone residencial e comercial) e 11 (telefone celular), além de serem únicos cadastrados.

Caso possua alguma incompatibilidade com o arquivo SQL, basta importá-lo dentro do phpMyAdmin com XAMPP:

https://www.apachefriends.org/pt_br/index.html -> Selecionar SO, e seguir passos para instalação. Verifique se as portas utilizadas estão disponíveis.
