@extends('layouts.app')

@section('title', 'Detalhes da Categoria')

@section('content')
<div id="categoryDetails"></div>

@section('scripts')
<script>
    const categoryId = {{ $id }};
    
    async function loadCategory() {
        try {
            const response = await fetch(`/api/categories/${categoryId}`);
            const category = await response.json();
            
            const container = document.getElementById('categoryDetails');
            container.innerHTML = `
                <div class="card">
                    <div class="card-body">
                        <h2>${category.name}</h2>
                        <p>${category.description || 'Sem descrição'}</p>
                        <a href="/categories" class="btn btn-secondary">Voltar</a>
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="/categories/${category.id}/edit" class="btn btn-primary">Editar</a>
                            @endif
                        @endauth
                    </div>
                </div>
            `;
        } catch (error) {
            console.error('Erro ao carregar categoria:', error);
        }
    }

    loadCategory();
</script>
@endsection
@endsection

