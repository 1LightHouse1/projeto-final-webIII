@extends('layouts.app')

@section('title', 'Categorias')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Categorias</h2>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Nova Categoria
            </a>
        @endif
    @endauth
</div>

<div class="row" id="categoriesContainer">
</div>

@section('scripts')
<script>
    async function loadCategories() {
        try {
            const response = await fetch('/api/categories');
            const categories = await response.json();
            
            const container = document.getElementById('categoriesContainer');
            container.innerHTML = '';
            
            categories.forEach(category => {
                const card = `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${category.name}</h5>
                                <p class="card-text">${category.description || ''}</p>
                                <a href="/categories/${category.id}" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                                @auth
                                    @if(Auth::user()->role === 'admin')
                                        <a href="/categories/${category.id}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        } catch (error) {
            console.error('Erro ao carregar categorias:', error);
        }
    }

    loadCategories();
</script>
@endsection
@endsection

