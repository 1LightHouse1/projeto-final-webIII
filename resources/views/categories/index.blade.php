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
    window.isAdmin = @json(Auth::check() && Auth::user()->role === 'admin');
</script>
<script src="{{ asset('js/categories-index.js') }}"></script>
@endsection
@endsection

