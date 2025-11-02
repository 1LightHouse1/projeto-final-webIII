@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Editar Produto</h4>
            </div>
            <div class="card-body">
                <form id="productForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Estoque</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoria</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Selecione uma categoria</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const token = localStorage.getItem('api_token');
    const productId = {{ $id }};
    
    async function loadProduct() {
        try {
            const response = await fetch(`/api/products/${productId}`);
            const product = await response.json();
            
            document.getElementById('name').value = product.name;
            document.getElementById('description').value = product.description || '';
            document.getElementById('price').value = product.price;
            document.getElementById('stock').value = product.stock;
        } catch (error) {
            console.error('Erro ao carregar produto:', error);
        }
    }
    
    async function loadCategories() {
        try {
            const response = await fetch('/api/categories');
            const categories = await response.json();
            
            const select = document.getElementById('category_id');
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                select.appendChild(option);
            });
            
            const productResponse = await fetch(`/api/products/${productId}`);
            const product = await productResponse.json();
            if (product.category_id) {
                select.value = product.category_id;
            }
        } catch (error) {
            console.error('Erro ao carregar categorias:', error);
        }
    }

    document.getElementById('productForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            price: document.getElementById('price').value,
            stock: document.getElementById('stock').value,
            category_id: document.getElementById('category_id').value
        };

        try {
            const response = await fetch(`/api/products/${productId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                window.location.href = '/products';
            } else {
                const data = await response.json();
                alert(data.message || 'Erro ao atualizar produto');
            }
        } catch (error) {
            alert('Erro ao atualizar produto');
        }
    });

    loadProduct();
    loadCategories();
</script>
@endsection
@endsection

