@extends('layouts.app')

@section('title', 'Editar Categoria')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Editar Categoria</h4>
            </div>
            <div class="card-body">
                <form id="categoryForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    const token = localStorage.getItem('api_token');
    const categoryId = {{ $id }};
    
    async function loadCategory() {
        try {
            const response = await fetch(`/api/categories/${categoryId}`);
            const category = await response.json();
            
            document.getElementById('name').value = category.name;
            document.getElementById('description').value = category.description || '';
        } catch (error) {
            console.error('Erro ao carregar categoria:', error);
        }
    }

    document.getElementById('categoryForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value
        };

        try {
            const response = await fetch(`/api/categories/${categoryId}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                window.location.href = '/categories';
            } else {
                const data = await response.json();
                alert(data.message || 'Erro ao atualizar categoria');
            }
        } catch (error) {
            alert('Erro ao atualizar categoria');
        }
    });

    loadCategory();
</script>
@endsection
@endsection

