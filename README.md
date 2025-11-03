# Sistema de E-Commerce - API RESTful

Sistema de e-commerce desenvolvido com Laravel, contendo API RESTful para gerenciamento de usuários, produtos, categorias e pedidos, com autenticação via token JWT usando Laravel Sanctum e controle de acesso com Gates e Policies.

## Requisitos

- PHP >= 8.2
- Composer
- MySQL (via XAMPP)
- XAMPP com Apache e MySQL ativos

##  Instalação

### 1. Clone o repositório ou baixe o projeto

```bash
cd projeto-final-webIII
```

### 2. Instale as dependências do Composer

```bash
composer install
```

### 3. Configure o banco de dados

Certifique-se de que o XAMPP está rodando com Apache e MySQL ativos na porta 3306.

Crie o banco de dados MySQL:

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Ou usando o prompt do MySQL do XAMPP:

```sql
CREATE DATABASE IF NOT EXISTS ecommerce CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Configure o arquivo .env

O arquivo `.env` já está configurado com:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Se precisar alterar, edite o arquivo `.env` na raiz do projeto.

### 5. Execute as migrations

```bash
php artisan migrate:fresh
```

Este comando criará todas as tabelas necessárias no banco de dados.

### 6. Execute os seeders (popular banco com dados de exemplo)

```bash
php artisan db:seed
```

Este comando criará:
- 1 usuário admin: `admin@ecommerce.com` / `admin123`
- 2 usuários comuns: `usuario@ecommerce.com` / `user123` e `joao@ecommerce.com` / `user123`
- 4 categorias de exemplo
- 8 produtos de exemplo

### 7. Gere a chave da aplicação (se necessário)

```bash
php artisan key:generate
```

## Executando o Projeto

### Inicie o servidor de desenvolvimento

```bash
php artisan serve
```

O projeto estará disponível em: `http://localhost:8000`

## Autenticação

O sistema utiliza Laravel Sanctum para autenticação via token JWT (Bearer Token).

### Endpoints de Autenticação

- **POST** `/api/register` - Registrar novo usuário
- **POST** `/api/login` - Gerar token de autenticação
- **POST** `/api/logout` - Revogar token

### Exemplo de uso

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@ecommerce.com","password":"admin123"}'
```

### Credenciais de Teste (após seeders)

**Admin:**
- Email: `admin@ecommerce.com`
- Senha: `admin123`

**Usuário Comum:**
- Email: `usuario@ecommerce.com`
- Senha: `user123`

## Documentação da API

A API está completamente documentada através de coleções do Postman/Insomnia:

- **`API_COLLECTION_POSTMAN.json`** - Para Postman
- **`API_COLLECTION.json`** - Para Insomnia
- **`GUIA_COLECAO_API.md`** - Guia completo de uso

### Como usar:

1. Importe a coleção no Postman ou Insomnia
2. Configure a variável `base_url` como `http://localhost:8000`
3. Execute os requests organizados por categoria

Consulte o arquivo `GUIA_COLECAO_API.md` para instruções detalhadas.


## Endpoints da API

### Rotas Públicas (não requerem autenticação)
- `GET /api/products` - Listar produtos
- `GET /api/products/{id}` - Visualizar produto
- `GET /api/categories` - Listar categorias
- `GET /api/categories/{id}` - Visualizar categoria
- `POST /api/register` - Registrar usuário
- `POST /api/login` - Autenticar

### Rotas Protegidas (requerem autenticação)
- `POST /api/logout` - Revogar token
- `GET /api/orders` - Listar pedidos do usuário
- `POST /api/orders` - Criar pedido
- `GET /api/orders/{id}` - Visualizar pedido
- `PUT /api/orders/{id}` - Atualizar pedido
- `DELETE /api/orders/{id}` - Deletar pedido

### Rotas Admin (requerem autenticação + role admin)
- `POST /api/products` - Criar produto
- `PUT /api/products/{id}` - Atualizar produto
- `DELETE /api/products/{id}` - Deletar produto
- `POST /api/categories` - Criar categoria
- `PUT /api/categories/{id}` - Atualizar categoria
- `DELETE /api/categories/{id}` - Deletar categoria


## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.
