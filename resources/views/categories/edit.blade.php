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
    window.categoryId = {{ $id }};
</script>
<script src="{{ asset('js/categories-edit.js') }}"></script>
@endsection
@endsection

