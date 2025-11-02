@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Produtos</h2>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Produto
            </a>
        @endif
    @endauth
</div>

<div class="row" id="productsContainer">
</div>

@section('scripts')
<script>
    async function loadProducts() {
        try {
            const response = await fetch('/api/products');
            const products = await response.json();
            
            const container = document.getElementById('productsContainer');
            container.innerHTML = '';
            
            products.forEach(product => {
                const card = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.description || ''}</p>
                                <p class="card-text"><strong>R$ ${parseFloat(product.price).toFixed(2)}</strong></p>
                                <p class="card-text">Estoque: ${product.stock}</p>
                                <p class="card-text">
                                    <small class="text-muted">Categoria: ${product.category ? product.category.name : 'Sem categoria'}</small>
                                </p>
                                <a href="/products/${product.id}" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <a href="/products/${product.id}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        } catch (error) {
            console.error('Erro ao carregar produtos:', error);
        }
    }

    loadProducts();
</script>
@endsection
@endsection

