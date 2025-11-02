@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<div id="productDetails"></div>

@section('scripts')
<script>
    const productId = {{ $id }};
    
    async function loadProduct() {
        try {
            const response = await fetch(`/api/products/${productId}`);
            const product = await response.json();
            
            const container = document.getElementById('productDetails');
            container.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <h2>${product.name}</h2>
                        <p>${product.description || 'Sem descrição'}</p>
                        <p><strong>Preço:</strong> R$ ${parseFloat(product.price).toFixed(2)}</p>
                        <p><strong>Estoque:</strong> ${product.stock}</p>
                        <p><strong>Categoria:</strong> ${product.category ? product.category.name : 'Sem categoria'}</p>
                        <a href="/products" class="btn btn-secondary">Voltar</a>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="/products/${product.id}/edit" class="btn btn-primary">Editar</a>
                            @endif
                        @endauth
                    </div>
                </div>
            `;
        } catch (error) {
            console.error('Erro ao carregar produto:', error);
        }
    }

    loadProduct();
</script>
@endsection
@endsection

