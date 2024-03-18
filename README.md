<h1 align="center" color="#F50057"> 
   Clinica Medica
</h1>


## :bookmark: Sobre 

Este repositório é um CRUD feito em PHP com a utilização do Framework Laravel.

A ideia do projeto foi apresentada no curso para projeto final, onde era necessário desenvolver uma Api rest de uma clínica médica.

Onde temos, consultas por especialidade. Com a relação many-to-many.

Consulta por medicamentos, com a relação many-to-many. Em que podemos relacionar consultas, pacientes e medicamentos.

As consultas estão numeradas tendo um campo NumeroConsulta na tabela consultas.

Aplicação de imagem no medico e pacientes.

Um paciente tem várias consultas. Relação um-para-muitos.

Uma especialidade tem vários médicos . Relação um-para-muitos.

Um médico tem várias agendas . Relação um-para-muitos

As agendas guardam uma consulta. Podendo ser atribuida aos médicos e com possível aplicação de outra entidade. Não aplicada por mim .Relação um-para-muitos.

# Como usar este template

Clone este repositório: https://github.com/luisolivei/Clinica-Medica.git

Instale as dependências: composer install

Nome_Database: api-clinica-medica

Colação: utf8mb4_unicode_ci

Execute as migrations do Banco de Dados: php artisan migrate

Start a aplicação: php artisan serve


# Tecnologias Utilizadas

> [PHP](https://www.php.net/) 
  
> [Laravel](https://laravel.com/) 
  
> [Laravel/ui](https://laravel.com/docs/7.x/frontend) 
  
> [MySQL](https://www.mysql.com/) 
  
> [Postman](https://www.postman.com/) 
  
> [GuitHub-Desktop](https://desktop.github.com/) 
  

# Funcionalidades

> **Login/Logout com Autenticação.** 
  
> **User** 
  
> **Imagens** 
  
> **Consultas** 
  
> **Pacientes** 
  
> **Medicos** 
  
> **Especialidades** 
  
> **Agendas** 
  
> **Medicação** 
  
> **Relações Usadas: Um para muitos e muitos para muitos.** 

 **Guia da API**

#### Esta Api returna as respostas no formato JSON.

#### Deve ser inserido no Headers da requesição via postman a Key Accept e o Value application/json. Para poder returnar as respostas em JSON.

#### Registar utilizador, preenchendo os campos: name,email,password e password_confirmation.

#### Ao fazer Login, preenchendo os campos: email, password. Irá ser fornecido um token. Deve copiá-lo para usar nas rotas que pretende aceder.

#### Aceder a uma rota protegida usando o baerer para inserir o token fornecido no login.

#### Acedendo a uma rota, podemos fazer CRUD da mesma. Preenchendo os campos obrigatórios descritos na documentação geral.

#### Pode adicionar uma imagem aos medicos e pacientes.

#### Preencher as relações entre os modelos.

#### Por fim , fazer logout.


<a id="como-contribuir"></a>
## :recycle: Como contribuir

- Faça um Fork desse repositório,
- Crie uma branch com a sua feature: `git checkout -b my-feature`
- Commit suas mudanças: `git commit -m 'feat: My new feature'`
- Push a sua branch: `git push origin my-feature`

## :memo: License

Esse projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.


