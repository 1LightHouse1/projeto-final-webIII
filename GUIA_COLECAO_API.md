# Guia de Uso da Coleção da API

Este documento explica como importar e usar as coleções da API no Postman ou Insomnia.

## Arquivos Disponíveis

- **`API_COLLECTION_POSTMAN.json`** - Coleção formatada para Postman (recomendado)
- **`API_COLLECTION.json`** - Coleção formatada para Insomnia

Ambas as coleções contêm os mesmos endpoints, apenas formatos diferentes.

---

## Como Importar no Postman

### Passo 1: Abrir Postman
1. Abra o Postman (se não tiver, baixe em: https://www.postman.com/downloads/)

### Passo 2: Importar Coleção
1. Clique em **"Import"** no canto superior esquerdo
2. Selecione **"Upload Files"**
3. Escolha o arquivo `API_COLLECTION_POSTMAN.json`
4. Clique em **"Import"**

### Passo 3: Configurar Variáveis de Ambiente
1. Após importar, você verá a coleção **"E-Commerce API - Laravel"**
2. Clique nos **"..."** ao lado do nome da coleção
3. Selecione **"Edit"**
4. Vá para a aba **"Variables"**
5. Configure as variáveis:
   - **`base_url`**: `http://localhost:8000`
   - **`token`**: Deixe vazio inicialmente (será preenchido automaticamente após login)

### Passo 4: Configurar Auto-Salvamento de Token (Opcional)
A requisição de **Login** já está configurada para salvar o token automaticamente:
1. Abra a requisição **"Login - Autenticar Usuário"**
2. Vá para a aba **"Tests"**
3. O código já está presente:
```javascript
if (pm.response.code === 200) {
    var jsonData = pm.response.json();
    pm.environment.set('token', jsonData.data.token);
    pm.environment.set('user_id', jsonData.data.user.id);
}
```

**Nota:** Para que isso funcione, você precisa criar um **Environment** no Postman:
1. Clique no ícone de engrenagem no canto superior direito
2. Clique em **"Add"** para criar um novo environment
3. Nomeie como **"Local"** ou **"Development"**
4. Adicione as variáveis:
   - `base_url`: `http://localhost:8000`
   - `token`: (deixe vazio)
5. Selecione este environment no dropdown no canto superior direito

---

## Como Importar no Insomnia

### Passo 1: Abrir Insomnia
1. Abra o Insomnia (se não tiver, baixe em: https://insomnia.rest/download)

### Passo 2: Importar Coleção
1. Clique em **"Create"** → **"Import/Export"**
2. Selecione **"Import Data"** → **"From File"**
3. Escolha o arquivo `API_COLLECTION.json`
4. A coleção será importada automaticamente

### Passo 3: Configurar Variáveis de Ambiente
1. No Insomnia, clique no ícone **"Manage Environments"** (Ctrl+E)
2. Crie um novo environment ou edite o existente
3. Adicione as variáveis:
   - `base_url`: `http://localhost:8000`
   - `token`: (deixe vazio)

---

## 📋 Estrutura da Coleção

A coleção está organizada em 4 pastas principais:

### 1. **Autenticação**
- `Register - Registrar Usuário` - POST `/api/register`
- `Login - Autenticar Usuário` - POST `/api/login`
- `Logout - Revogar Token` - POST `/api/logout`

### 2. **Produtos**
- `Listar Produtos (Público)` - GET `/api/products`
- `Visualizar Produto (Público)` - GET `/api/products/{id}`
- `Criar Produto (Admin)` - POST `/api/products` ⚠️ Requer autenticação e role admin
- `Atualizar Produto (Admin)` - PUT `/api/products/{id}` ⚠️ Requer autenticação e role admin
- `Deletar Produto (Admin)` - DELETE `/api/products/{id}` ⚠️ Requer autenticação e role admin

### 3. **Categorias**
- `Listar Categorias (Público)` - GET `/api/categories`
- `Visualizar Categoria (Público)` - GET `/api/categories/{id}`
- `Criar Categoria (Admin)` - POST `/api/categories` ⚠️ Requer autenticação e role admin
- `Atualizar Categoria (Admin)` - PUT `/api/categories/{id}` ⚠️ Requer autenticação e role admin
- `Deletar Categoria (Admin)` - DELETE `/api/categories/{id}` ⚠️ Requer autenticação e role admin

### 4. **Pedidos**
- `Listar Meus Pedidos` - GET `/api/orders` ⚠️ Requer autenticação
- `Criar Pedido` - POST `/api/orders` ⚠️ Requer autenticação
- `Visualizar Pedido` - GET `/api/orders/{id}` ⚠️ Requer autenticação (só próprio pedido)
- `Atualizar Pedido` - PUT `/api/orders/{id}` ⚠️ Requer autenticação (só próprio pedido)
- `Deletar Pedido` - DELETE `/api/orders/{id}` ⚠️ Requer autenticação (só próprio pedido)

---

## Como Testar os Cenários Obrigatórios

### Cenário 1: Registro, Login e Logout

1. **Registrar:**
   - Execute `Register - Registrar Usuário`
   - Copie o token retornado em `data.token`

2. **Login:**
   - Execute `Login - Autenticar Usuário`
   - Use credenciais: `admin@ecommerce.com` / `admin123` (admin)
   - Ou: `usuario@ecommerce.com` / `user123` (usuário comum)
   - O token será salvo automaticamente (se configurado)

3. **Logout:**
   - Execute `Logout - Revogar Token`
   - Verifique que retorna sucesso

---

### Cenário 2: Criação de Pedidos por Usuário Autenticado

1. **Login como usuário comum:**
   - Execute `Login` com: `usuario@ecommerce.com` / `user123`

2. **Criar pedido:**
   - Execute `Criar Pedido`
   - Body deve conter:
   ```json
   {
     "items": [
       {
         "product_id": 1,
         "quantity": 2
       },
       {
         "product_id": 2,
         "quantity": 1
       }
     ]
   }
   ```
   - Verifique que o total é calculado automaticamente
   - Verifique que retorna o pedido completo com `orderItems`

---

### Cenário 3: Tentativa de Criar Produto sem Permissão (Erro 403)

1. **Login como usuário comum (NÃO admin):**
   - Execute `Login` com: `usuario@ecommerce.com` / `user123`
   - Verifique que o token foi salvo

2. **Tentar criar produto:**
   - Execute `Criar Produto (Admin)`
   - Você deve receber: **Status 403 Forbidden**
   - Mensagem: `"This action is unauthorized."`

3. **Explicar:**
   - O Gate `manage-products` verifica se `user.role === 'admin'`
   - Usuários comuns recebem erro 403

---

### Cenário 4: Acesso de Administrador a Todos os Recursos

1. **Login como admin:**
   - Execute `Login` com: `admin@ecommerce.com` / `admin123`

2. **Testar criação de categoria:**
   - Execute `Criar Categoria (Admin)`
   - Body:
   ```json
   {
     "name": "Nova Categoria",
     "description": "Descrição teste"
   }
   ```
   - Deve retornar **Status 201 Created**

3. **Testar criação de produto:**
   - Execute `Criar Produto (Admin)`
   - Body:
   ```json
   {
     "name": "Novo Produto",
     "description": "Descrição do produto",
     "price": 99.90,
     "stock": 50,
     "category_id": 1
   }
   ```
   - Deve retornar **Status 201 Created**

4. **Testar outras operações:**
   - Atualizar produto
   - Deletar produto
   - Atualizar categoria
   - Deletar categoria
   - Todas devem funcionar (Status 200 ou 201)

---

## Formato das Respostas JSON

Todas as respostas seguem o padrão:

### Sucesso:
```json
{
  "status": "success",
  "message": "Produtos listados com sucesso",
  "data": [...]
}
```

### Erro:
```json
{
  "message": "This action is unauthorized."
}
```

---

## Credenciais de Teste

Após executar `php artisan db:seed`, você terá:

### Admin:
- **Email:** `admin@ecommerce.com`
- **Senha:** `admin123`
- **Role:** `admin`

### Usuários Comuns:
- **Email:** `usuario@ecommerce.com`
- **Senha:** `user123`
- **Role:** `user`

- **Email:** `joao@ecommerce.com`
- **Senha:** `user123`
- **Role:** `user`



