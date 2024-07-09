# Projeto Yii2 PHP

## Requisitos
- PHP 7.1
- Composer 1.10
- MySQL 8
- Docker (desejável)

## Configuração

### Clonar o Repositório

git clone <URL_DO_REPOSITORIO>
cd projeto-yii2-php
---------------------------------

## Configuração do Docker

Construir e iniciar os containers:

Copiar código
docker-compose up -d --build
Executar as migrations:

Copiar código
docker-compose exec web php yii migrate


## Uso
Executar a Aplicação
Iniciar os containers (se ainda não estiverem em execução):


Copiar código
docker-compose up -d
Acessar a aplicação:

Abra o navegador e acesse http://localhost:8080
Comandos Úteis
Criar um Usuário (Terminal)
bash
Copiar código
docker-compose exec web php yii user/create <username> <password> <name>


## APIs
Autenticação
POST /api/auth/login
Request:
Copiar código
{
  "username": "example",
  "password": "password"
}
Response:
Copiar código
{
  "token": "jwt-token"
}

Clientes
Listar Clientes
GET /api/clients
Headers:
Authorization: Bearer jwt-token
Response:
Copiar código
{
  "totalCount": 50,
  "pageCount": 5,
  "currentPage": 1,
  "perPage": 10,
  "clients": [
    {
      "id": 1,
      "name": "John Doe",
      "cpf": "123.456.789-00",
      "address": "Address 1",
      "photo": "photo1.png",
      "sexo": "M"
    }
    // Outros clientes...
  ]
}
Criar Cliente
POST /api/clients
Headers:
Authorization: Bearer jwt-token
Request:

Copiar código
{
  "name": "John Doe",
  "cpf": "123.456.789-00",
  "address": "Address 1",
  "photo": "base64-encoded-photo",
  "sexo": "M"
}
Visualizar Cliente
GET /api/clients/<id>
Headers:
Authorization: Bearer jwt-token
Atualizar Cliente
PUT /api/clients/<id>
Headers:
Authorization: Bearer jwt-token
Request:

Copiar código
{
  "name": "John Doe",
  "cpf": "123.456.789-00",
  "address": "Updated Address",
  "photo": "base64-encoded-photo",
  "sexo": "M"
}
Deletar Cliente
DELETE /api/clients/<id>
Headers:
Authorization: Bearer jwt-token
Produtos
Listar Produtos
GET /api/products
Headers:
Authorization: Bearer jwt-token
Response:
Copiar código
{
  "totalCount": 50,
  "pageCount": 5,
  "currentPage": 1,
  "perPage": 10,
  "products": [
    {
      "id": 1,
      "name": "Product Name",
      "price": 100.0,
      "client_id": 1,
      "photo": "photo1.png"
    }
    // Outros produtos...
  ]
}
Criar Produto
POST /api/products
Headers:
Authorization: Bearer jwt-token
Request:
json
Copiar código
{
  "name": "Product Name",
  "price": 100.0,
  "client_id": 1,
  "photo": "base64-encoded-photo"
}
Visualizar Produto
GET /api/products/<id>
Headers:
Authorization: Bearer jwt-token
Atualizar Produto
PUT /api/products/<id>
Headers:
Authorization: Bearer jwt-token
Request:

Copiar código
{
  "name": "Updated Product Name",
  "price": 150.0,
  "client_id": 1,
  "photo": "base64-encoded-photo"
}
Deletar Produto
DELETE /api/products/<id>
Headers:
Authorization: Bearer jwt-token
Contribuição
Fork o repositório
Crie uma branch para suas mudanças (git checkout -b feature/fooBar)
Faça commit das suas mudanças (git commit -am 'Add some fooBar')
Faça push para a branch (git push origin feature/fooBar)
Crie um novo Pull Request

###Licença

Descreva a licença do seu projeto aqui.

javascript
Copiar código

### Instruções Detalhadas de Uso

1. **Clonar o Repositório**
   - Clone o repositório do projeto para a sua máquina local:
     ```bash
     git clone <URL_DO_REPOSITORIO>
     cd projeto-yii2-php
     ```

2. **Configuração do Docker**
   - Construir e iniciar os containers:
     ```bash
     docker-compose up -d --build
     ```

3. **Executar as Migrations**
   - Execute as migrations para criar as tabelas no banco de dados:
     ```bash
     docker-compose exec web php yii migrate
     ```

4. **Acessar a Aplicação**
   - Abra o navegador e acesse `http://localhost:8080`

### Testar as APIs

Utilize ferramentas como Postman ou cURL para testar as APIs conforme descrito na seção de APIs no `README.md`.

### Resumo

Com o arquivo `README.md` configurado conforme o exemplo acima, os usuários do seu projeto te