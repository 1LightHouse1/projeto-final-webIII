# Sistema de E-Commerce - API RESTful

Sistema de e-commerce desenvolvido com Laravel, contendo API RESTful para gerenciamento de usuários, produtos, categorias e pedidos, com autenticação via token JWT usando Laravel Sanctum e controle de acesso com Gates e Policies.

## 📋 Requisitos

- PHP >= 8.2
- Composer
- MySQL (via XAMPP)
- XAMPP com Apache e MySQL ativos

## 🚀 Instalação

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

### 6. Gere a chave da aplicação (se necessário)

```bash
php artisan key:generate
```

## 🏃 Executando o Projeto

### Inicie o servidor de desenvolvimento

```bash
php artisan serve
```

O projeto estará disponível em: `http://localhost:8000`

## 🔐 Autenticação

O sistema utiliza Laravel Sanctum para autenticação via token JWT (Bearer Token).

### Endpoints de Autenticação

- **POST** `/api/register` - Registrar novo usuário
- **POST** `/api/login` - Gerar token de autenticação
- **POST** `/api/logout` - Revogar token

### Exemplo de uso

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"usuario@email.com","password":"senha123"}'
```

## 📄 Licença

Este projeto foi desenvolvido para fins educacionais.
